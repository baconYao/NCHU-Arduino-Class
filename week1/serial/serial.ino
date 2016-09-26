//define
/* This is serial ouput
	Serial.begin(9600);
	Serial.println("...");
	Serial.print("...");
*/

/* This is serial input
	//serial.available() is a boolean function, it will return a count
	if(Serial.available() > 0)
	{
		//Serial.read() is a read function, it read a character 
		char tmp = Serial.read();
		// if you want to read string, you need to declare an char array to store your input
	}
*/


//setup
void setup() {                
  Serial.begin(9600);       
}

//loop
void loop() {
  Serial.println("Hello World, My name is baconYao");
  Serial.println("You can input some messages here:");
  //delay(5000);
  //return buffer size < 64 Bytes
  if(Serial.available() > 0)
  { 
  	char tmp = Serial.read();
  	Serial.print(tmp);
  }
  else
  {
  	delay(5000);
  	Serial.println("Input action completed.");
  }

}
