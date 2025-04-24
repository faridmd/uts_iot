#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#include <DHT.h> 
#define DHTPIN 4 //D2
#define DHTTYPE DHT11 
DHT dht11(DHTPIN, DHTTYPE); 

String URL = "http://192.168.1.5:1337/uts_iot/web/test_data.php"; // sesuaikan IP Address dengan ip host

const char* ssid = "OpenWrt"; // sesuaikan SSID 
const char* password = "123456789"; // sesuaikan SSID Password

int temperature = 0;
int humidity = 0;

void setup() {
  Serial.begin(9600);
  dht11.begin(); 
  connectWiFi();
}

void loop() {
  if(WiFi.status() != WL_CONNECTED) {
    connectWiFi();
  }

  Load_DHT11_Data();
  String postData = "temp=" + String(temperature) + "&hum=" + String(humidity);

  WiFiClient client;
  HTTPClient http;
  http.begin(client, URL);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  int httpCode = http.POST(postData);
  String payload = http.getString();

  Serial.print("URL : "); Serial.println(URL); 
  Serial.print("Data: "); Serial.println(postData);
  Serial.print("httpCode: "); Serial.println(httpCode);
  Serial.print("payload : "); Serial.println(payload);
  Serial.println("--------------------------------------------------");
  delay(5000);
}


void Load_DHT11_Data() {
  //-----------------------------------------------------------
  temperature = dht11.readTemperature(); //Celsius
  humidity = dht11.readHumidity();
  //-----------------------------------------------------------
  // Check if any reads failed.
  if (isnan(temperature) || isnan(humidity)) {
    Serial.println("Failed to read from DHT sensor!");
    temperature = 0;
    humidity = 0;
  }
  //-----------------------------------------------------------
  Serial.printf("Temperature: %d °C\n", temperature);
  Serial.printf("Humidity: %d %%\n", humidity);
}

void connectWiFi() {
  WiFi.mode(WIFI_OFF);
  delay(1000);
  //This line hides the viewing of ESP as wifi hotspot
  WiFi.mode(WIFI_STA);
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
    
  Serial.print("connected to : "); Serial.println(ssid);
  Serial.print("IP address: "); Serial.println(WiFi.localIP());
}