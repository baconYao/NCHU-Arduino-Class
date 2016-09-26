//Photoresistance sample code

//A0 ~ A5 input's number range is 0~1023

int led =13;
int sensorPin = A2;    // select the input pin for the potentiometer
int sensorValue = 0;  // variable to store the value coming from the sensor

void setup() {
  	Serial.begin(9600);
  	pinMode(sensorPin, INPUT); 
  	pinMode(led, OUTPUT); 
 
}

void loop() {
	sensorValue = analogRead(sensorPin);    
	Serial.println(sensorValue);
    
	//return value < 500 will let LED shine, 512 means that the Photoresistance occupy 50%'s Voltage 
	if(sensorValue <500){
		digitalWrite(led, HIGH); 
		delay(1000);
   	}  
	else{  
		digitalWrite(led, LOW);    
		delay(1000);
	}
}
