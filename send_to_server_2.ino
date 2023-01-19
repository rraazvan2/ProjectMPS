void send_to_server_2() {

  url = location_url;
  url += NOOBIX_id;
  url += "&pw=";
  url += NOOBIX_password;  //sensor value
  url += "&un=1";
  url += "&n1=";
  url += String(sent_nr_2);  //sensor value

  URL_withPacket = "";

  URL_withPacket = (String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");

  /*
URL_withPacket += "Host: www.electronoobs.com\r\n";  
URL_withPacket += "Connection: close\r\n\r\n";  
  */
  /// This builds out the payload URL - not really needed here, but is very handy when adding different arrays to the payload
  counter = 0;  //keeps track of the payload size
  payload_size = 0;
  for (int i = 0; i < (URL_withPacket.length()); i++) {  //using a string this time, so use .length()
    payload[payload_size + i] = URL_withPacket[i];       //build up the payload
    counter++;                                           //increment the counter
  }                                                      //for int
  payload_size = counter + payload_size;                 //payload size is just the counter value - more on this when we need to build out the payload with more data
    //for(int i=0; i<payload_size; i++)//print the payload to the ESP
    //Serial.print(payload[i]);

  if (connect_ESP()) {                                                                //this calls 'connect_ESP()' and expects a '1' back if successful
                                                                                      //nice, we're in and ready to look for data
                                                                                      //first up, we need to parse the returned data  _t1123##_d15##_d210##
                                                                                      //Serial.println("connected ESP");
                                                                                      //we still have more data to get out of this stream, now we want d1
    if (read_until_ESP(keyword_n2, sizeof(keyword_n2), 5000, 0)) {                    //same as before - first d1
      if (read_until_ESP(keyword_doublehash, sizeof(keyword_doublehash), 5000, 1)) {  //now ## and mode=1
        for (int i = 1; i <= (scratch_data_from_ESP[0] - sizeof(keyword_doublehash) + 1); i++)
          d10_from_ESP[i] = scratch_data_from_ESP[i];
        d10_from_ESP[0] = (scratch_data_from_ESP[0] - sizeof(keyword_doublehash) + 1);
        //now that we have our data, go wait for the connection to disconnect
        //- the ESP will eventually return 'Unlink'
        //delay(10);
        Serial.println("FOUND DATA & DISCONNECTED SENZOR 2");
        serial_dump_ESP();  //now we can clear out the buffer and read whatever is still there
        //let's see how the data looks

        Serial.print("SENT_NUMBER_2 = ");  //print out LED data and convert to integer
        sent_nr_2_feedback = 0;
        for (int i = 1; i <= d10_from_ESP[0]; i++) {
          //Serial.print(d1_from_ESP[i]);
          sent_nr_2_feedback = sent_nr_2_feedback + ((d10_from_ESP[i] - 48) * multiplier[d10_from_ESP[0] - i]);
        }
        Serial.println(sent_nr_2_feedback);
        Serial.println("");
        //that's it!!
      }  //##
    }    //d2

  }  //connect ESP

}  //connect web host
