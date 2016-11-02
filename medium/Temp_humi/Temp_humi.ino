// 須將DHT11加到lib
#include <DHT11.h>

// 宣告溫濕度檢測器程式物件
const int dataPin = 2;

DHT11 dht11(dataPin); 

void setup() {
  Serial.begin(9600);
}

void loop() {
  
  int err;
  float temp, humi;
  if((err=dht11.read(humi, temp))==0)
  {
    Serial.print("temp=(");
    Serial.print(temp);
    Serial.print(")");
    Serial.print(", humi=(");
    Serial.print(humi);
    Serial.print(")");
    Serial.println();
  }
  else
  {
    Serial.println();
    Serial.print("Error No :");
    Serial.print(err);
    Serial.println();    
  }
  delay(DHT11_RETRY_DELAY); //delay for reread

}
