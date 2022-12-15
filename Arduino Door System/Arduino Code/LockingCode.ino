#include <RadioLib.h>
#include <WiFiNINA.h>
#include <ArduinoHttpClient.h>
#include <FreeRTOS_SAMD21.h>

char ssid[] = "charan";
char pass[] = "charan4321";
#define WIFI_TIMEOUT_MS 20000

String LOCK_ID = "1";

String serverAddress = "192.168.43.40";
String path = "/status_updater.php";
String contentType = "application/x-www-form-urlencoded";
String data_to_send = "check_lock_status=" + LOCK_ID;

WiFiClient wifi;
HttpClient client = HttpClient(wifi, serverAddress, 80);

int lock_pin = 2;
int buzzer_pin = 3;

TaskHandle_t keypad_handle = NULL;
TaskHandle_t server_response = NULL;

int j = 0;
int x = 0;

const char rows = 4; // set display to four rows
const char cols = 4; // set display to three columns

const char keys[rows][cols] = {
  {'1', '2', '3', 'A'},
  {'4', '5', '6', 'B'},
  {'7', '8', '9', 'C'},
  {'*', '0', '#', 'D'}
};

char rowPins[rows] = {A0, A1, A2, A3}; // connect to the row pinouts of the keypad
char colPins[cols] = {5, 4, A6, A7};   // connect to the column pinouts of the keypad

// Wiring: SDA pin is connected to A4 and SCL pin to A5.
const String password = "4321"; // change your password here
String input_password;

nRF24 radio = new Module(8, 10, 9);

void setup()
{
  Serial.begin(9600);
  input_password.reserve(32); // maximum input characters is 33, change if needed

  for (char r = 0; r < rows; r++)
  {
    pinMode(rowPins[r], INPUT);     // set the row pins as input
    digitalWrite(rowPins[r], HIGH); // turn on the pullups
  }

  for (char c = 0; c < cols; c++)
  {
    pinMode(colPins[c], OUTPUT); // set the column pins as output
  }

  pinMode(lock_pin, OUTPUT);
  pinMode(buzzer_pin, OUTPUT);
  digitalWrite(lock_pin, LOW);
  digitalWrite(buzzer_pin, LOW);

  WiFi.begin(ssid, pass);
  Serial.print("Attempting to connect to WPA SSID: ");
  Serial.println(ssid);
  while (WiFi.begin(ssid, pass) != WL_CONNECTED)
  {
    Serial.print(".");
    delay(5000);
  }

  Serial.print("You're connected to the network: ");
  Serial.println(ssid);
  Serial.print("Connected, my IP: ");
  Serial.println(WiFi.localIP());

  Serial.print(F("[nRF24] Initializing ... "));
  int state = radio.begin();
  if (state == RADIOLIB_ERR_NONE)
  {
    Serial.println(F("success!"));
  }
  else
  {
    Serial.print(F("failed, code "));
    Serial.println(state);
    for (int i = 0; i < 5; i++) {
      digitalWrite(buzzer_pin, HIGH);
      delay(1000);
      digitalWrite(buzzer_pin, LOW);
      delay(1000);
    }

    while (true) {
    };


  }

  Serial.print(F("[nRF24] Setting address for receive pipe 0 ... "));
  byte addr[] = {0x01, 0x23, 0x45, 0x67, 0x89};
  state = radio.setReceivePipe(0, addr);
  if (state == RADIOLIB_ERR_NONE)
  {
    Serial.println(F("success!"));
  }
  else
  {
    Serial.print(F("failed, code "));
    Serial.println(state);
    for (int i = 0; i < 5; i++) {
      digitalWrite(buzzer_pin, HIGH);
      delay(1000);
      digitalWrite(buzzer_pin, LOW);
      delay(1000);
    }

    while (true) {
    }
  }

  vSetErrorSerial(&Serial);

  // Creating Task
  // xTaskCreate(
  //     keepWifiAlive,
  //     "Wifi Alive",
  //     512,
  //     NULL,
  //     1,
  //     NULL
  // );

  xTaskCreate(
    updateFromServer,
    "Update",
    512,
    NULL,
    1,
    &server_response);

  xTaskCreate(
    keypad_unlock // Function Name
    ,
    "keypad" // Task name
    ,
    512 // Stack size
    ,
    NULL // Task parameters
    ,
    1 // Task Priority
    ,
    &keypad_handle // Task Handler
  );

  xTaskCreate(
    nRf24Recieve,
    "nrf",
    512,
    NULL,
    1,
    NULL);

  // Starting RTOS
  vTaskStartScheduler();
}

void loop()
{
}

void myDelayMs(int ms)
{
  vTaskDelay((ms * 1000) / portTICK_PERIOD_US);
}

void keepWifiAlive(void *parameters)
{
  for (;;)
  {
    if (WiFi.status() == WL_CONNECTED)
    {
      Serial.println("Wifi still connected");
      myDelayMs(10000);
      continue;
    }

    Serial.print("Attempting to connect to WPA SSID: ");
    Serial.println(ssid);
    WiFi.begin(ssid, pass);
    unsigned long startAttemptTime = millis();

    while (WiFi.begin(ssid, pass) != WL_CONNECTED && millis() - startAttemptTime < WIFI_TIMEOUT_MS)
    {
    }

    if (WiFi.status() != WL_CONNECTED)
    {
      Serial.println("Wifi Failed");
      myDelayMs(20000);
      continue;
    }

    Serial.print("You're connected to the network: ");
    Serial.println(ssid);
    Serial.print("Connected, my IP: ");
    Serial.println(WiFi.localIP());
  }
}

void wifiConnect()
{
  Serial.print("Attempting to connect to WPA SSID: ");
  Serial.println(ssid);
  while (WiFi.begin(ssid, pass) != WL_CONNECTED)
  {
    Serial.print(".");
    myDelayMs(5000);
  }

  Serial.print("You're connected to the network: ");
  Serial.println(ssid);
  Serial.print("Connected, my IP: ");
  Serial.println(WiFi.localIP());
}

void updateFromServer(void *parameters)
{

  for (;;)
  {
    if (WiFi.status() == WL_CONNECTED)
    {
      client.post(path, contentType, data_to_send);

      int response_code = client.responseStatusCode();

      if (response_code > 0)
      {
        if (response_code == -1)
        {
          Serial.println("HTTP ERROR CONNECTION FAILED: " + String(response_code));
        }
        else if (response_code == -2)
        {
          Serial.println("HTTP ERROR API (Wrong parameters passed in function): " + String(response_code));
        }
        else if (response_code == -3)
        {
          Serial.println("HTTP ERROR TIMEOUT: " + String(response_code));
        }
        else if (response_code == -4)
        {
          Serial.println("HTTP ERROR INVALID RESPONSE: " + String(response_code));
        }
        else if (response_code == 200)
        {
          String response_body = client.responseBody();
          Serial.print("Server Response: ");
          Serial.println(response_body);

          if (response_body == "LOCK")
          {
            digitalWrite(lock_pin, LOW);
          }
          else if (response_body == "UNLOCK")
          {
            digitalWrite(lock_pin, HIGH);
          }
        }
      }
      else
      {
        Serial.println("ERROR SENDING POST: " + String(response_code));
      }
    }
    else
    {
      wifiConnect();
    }

    myDelayMs(100);
  }
}

void nRf24Recieve(void *parametere)
{
  for (;;)
  {
    String str;
    int state = radio.receive(str);

    if (state == RADIOLIB_ERR_NONE)
    {
      // packet was successfully received

      if (str == "OK")
      {
        Serial.println(str);
        continue;
      }
      else if (str == "DANGER")
      {
        vTaskSuspendAll();

        digitalWrite(lock_pin, HIGH);

        digitalWrite(buzzer_pin, HIGH);
        myDelayMs(500);
        digitalWrite(buzzer_pin, LOW);
      }
      else
      {
        //
      }

      // print the data of the packet
    }
  }
}

void keypad_unlock(void *parameters)
{
  for (;;)
  {
    char key = getKey();

    if (key)
    {

      Serial.println(key);

      if (key == '*')
      {
        input_password = ""; // clear input password
        x = 0;
      }
      else if (key == '#')
      {

        if (password == input_password)
        {
          Serial.println("password is correct");
          Serial.println(input_password);

          if (server_response != NULL)
          {
            vTaskSuspend(server_response);
          }

          digitalWrite(buzzer_pin, HIGH);
          myDelayMs(100);
          digitalWrite(buzzer_pin, LOW);
          digitalWrite(lock_pin, HIGH);
          myDelayMs(4000);
          digitalWrite(lock_pin, LOW);
          if (server_response != NULL)
          {
            vTaskResume(server_response);
          }


        }
        else
        {
          Serial.println("password is incorrect, try again");
          digitalWrite(buzzer_pin, HIGH);
          myDelayMs(100);
          digitalWrite(buzzer_pin, LOW);
          myDelayMs(100);
          digitalWrite(buzzer_pin, HIGH);
          myDelayMs(100);
          digitalWrite(buzzer_pin, LOW);
          myDelayMs(100);
          digitalWrite(buzzer_pin, HIGH);
          myDelayMs(100);
          digitalWrite(buzzer_pin, LOW);
        }

        input_password = ""; // clear input password
        x = 0;
      }
      else
      {
        x = 1;
        input_password += key; // append new character to input password string
        // print * key as hiden character
      }
    }
  }
}

char getKey()
{
  char k = 0;

  for (char c = 0; c < cols; c++)
  {
    digitalWrite(colPins[c], LOW);
    for (char r = 0; r < rows; r++)
    {
      if (digitalRead(rowPins[r]) == LOW)
      {
        myDelayMs(20); // 20ms debounce time
        while (digitalRead(rowPins[r]) == LOW)
          ;
        k = keys[r][c];
      }
    }
    digitalWrite(colPins[c], HIGH);
  }
  return k;
}
