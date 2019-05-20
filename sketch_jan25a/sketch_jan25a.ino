#include <ESP8266WiFi.h>
#include "DHT.h"
#include <Servo.h>

Servo servo;

#define DHTTYPE DHT11 
const int DHTPin = 5; //temperature
DHT dht(DHTPin, DHTTYPE);

const char* ssid = "JaraWifi";
const char* password = "jaraz12345";

bool autoStatus = false;

WiFiServer server(80);

void setup() {  
  pinMode(4, OUTPUT);//light
  pinMode(14, OUTPUT);//tankvalve
  pinMode(12,OUTPUT);//fan
    
  Serial.begin(115200);
  dht.begin();
  servo.attach(2); // door
  servo.write(0);
  
  delay(10);  
  
  // Connect to WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  
  // Start the server
  server.begin();
  Serial.println("Server started");

  // Print the IP address
  Serial.println(WiFi.localIP());
}

void loop() {
  String s;
  String temp = String(dht.readTemperature(),2);
  String humid = String(dht.readHumidity(),2);
  
  //automatic temp control module
  if(autoStatus){
    if(dht.readTemperature() > 25){
      servo.write(120);
    }
    else{
      servo.write(0);  
    }  
  }
  
       
  // Check if a client has connected
  WiFiClient client = server.available();
  if (!client) {
    return;
  }
  
  // Wait until the client sends some data
  Serial.println("new client");
  while(!client.available()){
    delay(1);
  }
  
  // Read the first line of the request
  String req = client.readStringUntil('\r');
  Serial.println(req);
  client.flush();

  if (req.indexOf("/toggleauto") != -1){
    autoStatus = !autoStatus;
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nSuccess";    
  }  
  else if (req.indexOf("/getautostatus") != -1){   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\n" + String(autoStatus);    
  }
  else if (req.indexOf("/gettemp") != -1){
    Serial.println("Temperature : " + temp);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\n" + temp;    
  }  
  else if (req.indexOf("/gethum") != -1){    
    Serial.println("Humidity : " + humid);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\n" + humid;    
  } 
  else if (req.indexOf("/getreadings") != -1){
    Serial.println("Temperature : " + temp);
    Serial.println("Humidity : " + humid);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\n" + temp + "&" + humid;    
  }
  else if (req.indexOf("/lighton") != -1){
    digitalWrite(4, HIGH);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nLightOn";    
  }
  else if (req.indexOf("/lightoff") != -1){
    digitalWrite(4, LOW);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nLightOFf";    
  } 
  else if (req.indexOf("/nlighton") != -1){
    digitalWrite(4, HIGH);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nnLightOn";    
  }
  else if (req.indexOf("/nlightoff") != -1){
    digitalWrite(4, LOW);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nnLightOFf";    
  } 
  else if (req.indexOf("/dooropen") != -1){
    servo.write(120);  
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\ndooropen";    
  }
  else if (req.indexOf("/doorclose") != -1){
    servo.write(0);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\ndoorclose";    
  }
  else if (req.indexOf("/valveopen") != -1){
    digitalWrite(14, HIGH);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nvalveopen";    
  }
  else if (req.indexOf("/valveclose") != -1){
    digitalWrite(14, LOW);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nvalveclose";    
  } 
  else if (req.indexOf("/alarmon") != -1){
    digitalWrite(4, HIGH);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nalarmOn";    
  }
  else if (req.indexOf("/alarmoff") != -1){
    digitalWrite(4, LOW);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nalarmOFf";    
  } 
  else if (req.indexOf("/fanon") != -1){
    digitalWrite(12, HIGH);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nFanOn";    
  }
  else if (req.indexOf("/fanoff") != -1){
    digitalWrite(12, LOW);
   
    s = "HTTP/1.1 200 OK\r\nAccess-Control-Allow-Origin: *\r\nAccess-Control-Allow- Methods: GET\r\nAccess-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept\r\nContent-Type: text/plain\r\n\r\nFanOFf";    
  }        
  else {
    Serial.println("invalid request");
    client.stop();
    return;
  }
  
  client.flush();

  // Send the response to the client
  client.print(s);
  delay(1);
  Serial.println("Client disonnected");

  // The client will actually be disconnected 
  // when the function returns and 'client' object is detroyed 

}
  
  
