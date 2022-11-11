#include <ArduinoHttpClient.h>
#include <WiFiNINA.h>

#define LOCK_PIN LED_BUILTIN

char ssid[] = "Charan";
char pass[] = "charan4321";

String LED_id = "1";

char serverAddress[] = "192.168.43.46";
String path = "/arduino/esp32_update.php";

WiFiClient wifi;
HttpClient client = HttpClient(wifi, serverAddress, 80);

String contentType = "application/x-www-form-urlencoded";
String data_to_send = "check_lock_status=" + LED_id;

void wifiConnect();
void sendPostReq(String path, String contentType, String data);

void setup()
{
  delay(10);
  Serial.begin(9600);
  pinMode(LED_BUILTIN, OUTPUT);
  WiFi.begin(ssid, pass);

  wifiConnect();
}

void loop()
{
  if (true)
  {
    if (WiFi.status() != WL_CONNECTED)
    {
      wifiConnect();
    }

    sendPostReq(path, contentType, data_to_send);
  }
}

void wifiConnect()
{
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
}

void sendPostReq(String path, String contentType, String data)
{
  client.post(path, contentType, data);

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
        digitalWrite(LOCK_PIN, LOW);
      }
      else if (response_body == "UNLOCK")
      {
        digitalWrite(LOCK_PIN, HIGH);
      }
    }
  }
  else
  {
    Serial.println("ERROR SENDING POST: " + String(response_code));
  }
}
