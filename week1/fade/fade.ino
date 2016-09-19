int interval = 200;    // how many points to add/subtract the LED by
int blink = 1000;      //The LED initial state
int turn = 1;
int upBound = 2000;
int lowBound = 200;
#define LED 13  //This instruction will not occupy memory

void setup()  { 
  // declare pin 9 to be an output:
  pinMode(13, OUTPUT);
} 

void loop()  { 
  digitalWrite(13, HIGH);   // set the LED on
  delay(blink);              // wait for a second
  digitalWrite(13, LOW);    // set the LED off
  delay(blink);              // wait for a second   

  // reverse the direction of the fading at the ends of the fade: 
  if (blink > upBound) 
  {
    blink -= interval ; 
    turn = 1;
  }
  else if (blink <= lowBound)  
  {
    blink += interval ;
    turn = 0; 
  }
  else if (blink <= upBound && turn)  
  {
    blink -= interval ; 
  }   
  else if (blink > lowBound && !turn)  
  {
    blink += interval ; 
  }

}
