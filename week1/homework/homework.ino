/*
  Author: Pei-Yao Chang
  Date: 2016/9/19
  Program request:
    1. Write a menu to select flash rate

    =========

    Please select the flash rate by the number:

    1. flash rate is 2 sec

    2. flash rate is 1 sec

    3. flash rate is 0.5 sec
  
*/

//define




//setup
void setup() {                
  Serial.begin(9600);  
  pinMode(13, OUTPUT);       
}

//loop
void loop() {
  Serial.println("--------------------------------------------");
  Serial.println("Please select the flash rate by the number:");
  Serial.println("You have 5 seconds to input number!!");
  Serial.println(" ");
  Serial.println("1. flash rate is 2 sec");
  Serial.println("2. flash rate is 1 sec");
  Serial.println("3. flash rate is 0.5 sec");
  Serial.println(" ");
  delay(5000);              // wait for 5 seconds

  if(Serial.available() > 0)
  { 
  	char select = Serial.read();
    Serial.print("Your select is number: ");
  	Serial.print(select);

    int i = 0;
    //show result 5 times
    for(i = 0; i < 5; i++)
    {
      if(select == '1')
      {
        digitalWrite(13, HIGH);   // set the LED on
        delay(2000);              // wait for a second
        digitalWrite(13, LOW);    // set the LED off
        delay(2000);              // wait for a second
      }
      else if (select == '2')
      {
        digitalWrite(13, HIGH);   // set the LED on
        delay(1000);              // wait for a second
        digitalWrite(13, LOW);    // set the LED off
        delay(1000);              // wait for a second
      }
      else if (select == '3')
      {
        digitalWrite(13, HIGH);   // set the LED on
        delay(500);              // wait for a second
        digitalWrite(13, LOW);    // set the LED off
        delay(500);              // wait for a second
      }
    }
  }
  else
  {
    Serial.println(" ");
    Serial.println("Input action completed.");
    Serial.println(" ");
  }
  delay(2000);              // wait for 2 seconds


}
