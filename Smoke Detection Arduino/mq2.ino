#include <MQ2.h>
int smoker = A0;
int lpg, co, smoke; 

MQ2 mq2(smoker); 

void setup() {
  pinMode(smoker, INPUT);
  Serial.begin(9600);
  mq2.begin(); 
}

void loop(){
  float* values= mq2.read(true); //set it false if you don't want to print the values in the Serial
  //lpg = values[0];
  lpg = mq2.readLPG();
  //co = values[1];
  co = mq2.readCO();
  //smoke = values[2];
  smoke = mq2.readSmoke();

  Serial.println(lpg);
  Serial.println(co);
  Serial.println(smoke); 
  delay(1000);
}
