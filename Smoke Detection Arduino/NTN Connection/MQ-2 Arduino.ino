#include <RadioLib.h>
#include <MQ2.h>
nRF24 radio = new Module(8, 10, 9);

int pin = A7;
int lpg, co, smoke;
MQ2 mq2(pin);
String message;

void setup()
{
    Serial.begin(9600);
    mq2.begin();
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
        for (;;)
        {
            digitalWrite(buzzer_pin, HIGH);
            delay(1000);
            digitalWrite(buzzer_pin, LOW);
            delay(1000);
        };
    }

    byte addr[] = {0x01, 0x23, 0x45, 0x67, 0x89};
    Serial.print(F("[nRF24] Setting transmit pipe ... "));
    state = radio.setTransmitPipe(addr);
    if (state == RADIOLIB_ERR_NONE)
    {
        Serial.println(F("success!"));
    }
    else
    {
        Serial.print(F("failed, code "));
        Serial.println(state);
        for (;;)
        {
            digitalWrite(buzzer_pin, HIGH);
            delay(1000);
            digitalWrite(buzzer_pin, LOW);
            delay(1000);
        };
    }
}

void loop()
{

    lpg = (mq2.readLPG());
    co = (mq2.readCO());
    smoke = (mq2.readSmoke());

    if (smoke > 100)
    {
        message = "danger";
    }
    if (co > 175)
    {
        message = "danger";
    }
    if (lpg > 1000)
    {
        message = "danger";
    }
    else
    {
        message = "okay";
    }

    int state = radio.transmit(message);
    Serial.println(message);

    delay(1000);
}
