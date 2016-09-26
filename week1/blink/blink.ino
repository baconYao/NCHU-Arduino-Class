//define
//int led = 13;   //This instruction will occupy memory
#define LED 13  //This instruction will not occupy memory

//setup
void setup() {                
  // initialize the digital pin as an output.
  // Pin 13 has an LED connected on most Arduino boards:
  pinMode(13, OUTPUT);     
}

//loop
void loop() {
  digitalWrite(13, HIGH);   // set the LED on
  delay(2500);              // wait for a second
  digitalWrite(13, LOW);    // set the LED off
  delay(500);              // wait for a second
}
