//Include the needed library, we will use softer serial communication with the ESP8266
#include <SoftwareSerial.h>
#include <avr/power.h>
#include <DHT.h>

//Define the used
#define ESP8266_RX 10  //Connect the TX pin from the ESP to this RX pin of the Arduino
#define ESP8266_TX 11  //Connect the TX pin from the Arduino to the RX pin of ESP

#define DHTTYPE DHT11                 // type of DHT sensor
#define interval 2000                 // interval bewtween each reading
#define temperature_senzor_pin 3      // pin for DHT sensor 1
#define temperature_sensor_pin_2 4    // pin for DHT sensor 2
#define temperature_sensor_pin_3 5    // pin for DHT sensor 3
#define temperature_sensor_pin_4 6    // pin for DHT sensor 4
#define temperature_sensor_pin_5 7    // pin for DHT sensor 5
#define temperature_sensor_pin_6 8    // pin for DHT sensor 6
#define temperature_sensor_pin_7 9    // pin for DHT sensor 7
#define temperature_sensor_pin_8 10   // pin for DHT sensor 8
#define temperature_sensor_pin_9 11   // pin for DHT sensor 9
#define temperature_sensor_pin_10 12  // pin for DHT sensor 10


unsigned long previousMillis = 0;  // will store the last time DHT was updated

DHT dht(temperature_senzor_pin, DHTTYPE);
DHT dht_2(temperature_sensor_pin_2, DHTTYPE);
DHT dht_3(temperature_sensor_pin_3, DHTTYPE);
DHT dht_4(temperature_sensor_pin_4, DHTTYPE);
DHT dht_5(temperature_sensor_pin_5, DHTTYPE);
DHT dht_6(temperature_sensor_pin_6, DHTTYPE);
DHT dht_7(temperature_sensor_pin_7, DHTTYPE);
DHT dht_8(temperature_sensor_pin_8, DHTTYPE);
DHT dht_9(temperature_sensor_pin_9, DHTTYPE);
DHT dht_10(temperature_sensor_pin_10, DHTTYPE);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////Variables you must change according to your values/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Add your data: SSID + KEY + host + location + id + password
//////////////////////////////////////////////
const char SSID_ESP[] = "MiFibra-4132";         //Give EXACT name of your WIFI
const char SSID_KEY[] = "vzP5anY5";             //Add the password of that WIFI connection
const char* host = "amintiridecalitate.ro";  //Add the host without "www" Example: electronoobs.com
String NOOBIX_id = "99999";                     //This is the ID you have on your database, I've used 99999 becuase there is a maximum of 5 characters
String NOOBIX_password = "12345";               //Add the password from the database, also maximum 5 characters and only numerical values
String location_url = "/pages/MPS/TX.php?id=";            //location of your PHP file on the server. In this case the TX.php is directly on the first folder of the server
                                                //If you have the files in a different folder, add thas as well, Example: "/ESP/TX.php?id="     Where the folder is ESP
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//Used variables in the code
String url = "";
String URL_withPacket = "";
unsigned long multiplier[] = { 1, 10, 100, 1000, 10000, 100000, 1000000, 10000000, 100000000, 1000000000 };
//MODES for the ESP
const char CWMODE = '1';  //CWMODE 1=STATION, 2=APMODE, 3=BOTH
const char CIPMUX = '1';  //CWMODE 0=Single Connection, 1=Multiple Connections


//Define the used functions later in the code, thanks to Kevin Darrah, YT channel:  https://www.youtube.com/user/kdarrah1234
boolean setup_ESP();
boolean read_until_ESP(const char keyword1[], int key_size, int timeout_val, byte mode);
void timeout_start();
boolean timeout_check(int timeout_ms);
void serial_dump_ESP();
boolean connect_ESP();
void connect_webhost();
unsigned long timeout_start_val;
char scratch_data_from_ESP[20];  //first byte is the length of bytes
char payload[200];
byte payload_size = 0, counter = 0;
char ip_address[16];


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//Variable to SEND to the DATABASE

float sent_nr_1 = 0;
float sent_nr_2 = 0;
float sent_nr_3 = 0;
float sent_nr_4 = 0;
float sent_nr_5 = 0;
float sent_nr_6 = 0;
float sent_nr_7 = 0;
float sent_nr_8 = 0;
float sent_nr_9 = 0;
float sent_nr_10 = 0;

/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
int sent_nr_1_feedback = 0;
int sent_nr_2_feedback = 0;
int sent_nr_3_feedback = 0;
int sent_nr_4_feedback = 0;
int sent_nr_5_feedback = 0;
int sent_nr_6_feedback = 0;
int sent_nr_7_feedback = 0;
int sent_nr_8_feedback = 0;
int sent_nr_9_feedback = 0;
int sent_nr_10_feedback = 0;



//Store received chars in this variables
char t1_from_ESP[5];     //For time from web
char d1_from_ESP[2];     //For received_bool_2
char d2_from_ESP[2];     //For received_bool_2
char d3_from_ESP[2];     //For received_bool_3
char d4_from_ESP[2];     //For received_bool_4
char d5_from_ESP[2];     //For received_bool_5
char d9_from_ESP[6];     //For received_nr_1
char d10_from_ESP[6];    //For received_nr_2
char d11_from_ESP[6];    //For received_nr_3
char d12_from_ESP[6];    //For received_nr_4
char d13_from_ESP[6];    //For received_nr_5
char d14_from_ESP[300];  //For received_text


//DEFINE KEYWORDS HERE
const char keyword_OK[] = "OK";
const char keyword_Ready[] = "Ready";
const char keyword_no_change[] = "no change";
const char keyword_blank[] = "#&";
const char keyword_ip[] = "192.";
const char keyword_rn[] = "\r\n";
const char keyword_quote[] = "\"";
const char keyword_carrot[] = ">";
const char keyword_sendok[] = "SEND OK";
const char keyword_linkdisc[] = "Unlink";

const char keyword_n1[] = "n1";
const char keyword_n2[] = "n2";
const char keyword_n3[] = "n3";
const char keyword_n4[] = "n4";
const char keyword_n5[] = "n5";
const char keyword_n6[] = "n6";
const char keyword_n7[] = "n7";
const char keyword_n8[] = "n8";
const char keyword_n9[] = "n9";
const char keyword_n10[] = "n10";
const char keyword_doublehash[] = "##";


SoftwareSerial ESP8266(ESP8266_RX, ESP8266_TX);  // rx tx



void setup() {  //        SETUP     START

  //Pin Modes for ESP TX/RX
  pinMode(ESP8266_RX, INPUT);
  pinMode(ESP8266_TX, OUTPUT);

  ESP8266.begin(9600);  //default baudrate for ESP
  ESP8266.listen();     //not needed unless using other software serial instances
  dht.begin();          // initialisation DHT sensor
  dht_2.begin();        // initalization DHT sensor 2
  dht_3.begin();        // initialization DHT sensor 3
  dht_4.begin();        // initialization DHT sensor 4
  dht_5.begin();        // initialization DHT sensor 5
  dht_6.begin();        // initialization DHT sensor 6
  dht_7.begin();        // initialization DHT sensor 7
  dht_8.begin();        // initialization DHT sensor 8
  dht_9.begin();        // initialization DHT sensor 9
  dht_10.begin();       // initialization DHT sensor 10
  Serial.begin(9600);   //for status and debug

  delay(2000);  //delay before kicking things off
  setup_ESP();  //go setup the ESP
}




void loop() {

  if ((millis() - previousMillis) > interval) {

    sent_nr_1 = dht.readTemperature();

    if (isnan(sent_nr_1)) {

      Serial.println("Senzor 1, nu este conectat!");
      sent_nr_1 = 255;
      send_to_server_1();

    } else {

      send_to_server_1();
    }

    sent_nr_2 = dht_2.readTemperature();

    if (isnan(sent_nr_2)) {

      Serial.println("Senzorul 2, nu este conectat");
      sent_nr_2 = 255;
      send_to_server_2();

    } else {

      send_to_server_2();
    }

    sent_nr_3 = dht_3.readTemperature();

    if (isnan(sent_nr_3)) {

      Serial.println("Senzorul 3, nu este conectat!");
      sent_nr_3 = 255;
      send_to_server_3();

    } else {

      send_to_server_3();
    }

    sent_nr_4 = dht_4.readTemperature();

    if (isnan(sent_nr_4)) {

      Serial.println("Senzorul 4, nu este conectat!");
      sent_nr_4 = 255;
      send_to_server_4();      

    } else {

      send_to_server_4();
    }

    sent_nr_5 = dht_5.readTemperature();

    if (isnan(sent_nr_5)) {

      Serial.println("Senzorul 5, nu este conectat!");
      sent_nr_5 = 255;
      send_to_server_5();

    } else {

      send_to_server_5();
    }

    sent_nr_6 = dht_6.readTemperature();

    if (isnan(sent_nr_6)) {

      Serial.println("Senzorul 6, nu este conectat!");
      sent_nr_6 = 255;
      send_to_server_6();

    } else {

      send_to_server_6();
    }

    sent_nr_7 = dht_7.readTemperature();

    if (isnan(sent_nr_7)) {

      Serial.println("Senzorul 7, nu este conectat!");
      sent_nr_7 = 255;
      send_to_server_7();

    } else {

      send_to_server_7();
    }

    sent_nr_8 = dht_8.readTemperature();

    if (isnan(sent_nr_8)) {

      Serial.println("Senzorul 8, nu este conectat!");
      sent_nr_8 = 255;
      send_to_server_8();

    } else {

      send_to_server_8();
    }

    sent_nr_9 = dht_9.readTemperature();

    if (isnan(sent_nr_9)) {

      Serial.println("Senzorul 9, nu este conectat!");
      sent_nr_9 = 255;
      send_to_server_9();

    } else {

      send_to_server_9();
    }

    sent_nr_10 = dht_10.readTemperature();

    if (isnan(sent_nr_10)) {

      Serial.println("Senzorul 10, nu este conectat!");
      sent_nr_10 = 255;
      send_to_server_10();

    } else {

      send_to_server_10();
    }


    previousMillis = millis();
  }

}  //End of the main loop
