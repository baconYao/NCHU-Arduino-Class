//define
#include <SoftwareSerial.h>
SoftwareSerial BT(2,3);// rx=2, tx=3
char val; // 儲存接收資料的變數

//setup
void setup() {
  	Serial.begin(9600); //pin 0, 1 
 	  // 設定藍牙模組的連線速率
    // 如果是HC-05，請改成38400
 	  BT.begin(9600); //pin 0, 1
    Serial.println("BT is ready!");
}

void loop() {
  // 若收到「序列埠監控視窗」的資料，則送到藍牙模組
	if(Serial.available())
	{
      val = Serial.read();
			BT.print(val);
	}
  // 若收到藍牙模組的資料，則送到「序列埠監控視窗」
	if(BT.available())
	{
      val = BT.read();
			Serial.print(val);
	}
}



/*
	AT comment:兩個MCU(Arduino & Bluetooth)透過四條線(serial)傳輸"字串"的溝通
	image: 
		http://imgur.com/a/RNTf4
		http://imgur.com/LbIblQj
*/
