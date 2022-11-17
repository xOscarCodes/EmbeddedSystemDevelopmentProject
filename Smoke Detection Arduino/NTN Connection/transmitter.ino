#include <RadioLib.h>
#include <MQ2.h>
nRF24 radio = new Module(8, 10, 9);

int pin = A0;
String lpg, co, smoke;

MQ2 mq2(pin);

void setup() {
  Serial.begin(9600);
    mq2.begin();
  Serial.print(F("[nRF24] Initializing ... "));
  int state = radio.begin();
  if(state == RADIOLIB_ERR_NONE) {
    Serial.println(F("success!"));
  } else {
    Serial.print(F("failed, code "));
    Serial.println(state);
    while(true);
  }
  
  byte addr[] = {0x01, 0x23, 0x45, 0x67, 0x89};
  Serial.print(F("[nRF24] Setting transmit pipe ... "));
  state = radio.setTransmitPipe(addr);
  if(state == RADIOLIB_ERR_NONE) {
    Serial.println(F("success!"));
  } else {
    Serial.print(F("failed, code "));
    Serial.println(state);
    while(true);
  }
}

void loop() {

lpg = String(mq2.readLPG());
co = String(mq2.readCO());
smoke = String(mq2.readSmoke());

Serial.println(lpg);
Serial.println(co);
Serial.println(smoke);

String sends =  lpg+ " "+co+ " "+ smoke;
int state = radio.transmit(sends);


 
//  if (state == RADIOLIB_ERR_NONE) {
//    // the packet was successfully transmitted
//    Serial.println(F("success!"));
//
//  } else if (state == RADIOLIB_ERR_PACKET_TOO_LONG) {
//    // the supplied packet was longer than 32 bytes
//    Serial.println(F("too long!"));
//
//  } else if (state == RADIOLIB_ERR_ACK_NOT_RECEIVED) {
//    // acknowledge from destination module
//    // was not received within 15 retries
//    Serial.println(F("ACK not received!"));
//
//  } else if (state == RADIOLIB_ERR_TX_TIMEOUT) {
//    // timed out while transmitting
//    Serial.println(F("timeout!"));
//
//  } else {
//    // some other error occurred
//    Serial.print(F("failed, code "));
//    Serial.println(state);
//
//  }

  // wait for a second before transmitting again
  // delay(1000);
}
