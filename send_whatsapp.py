import pywhatkit
import sys
import time

if len(sys.argv) == 3:
    phone_number = sys.argv[1]
    message = sys.argv[2]

    try:
        
        now = time.localtime()
        send_hour = now.tm_hour
        send_minute = now.tm_min + 3

      
        if send_minute >= 60:
            send_hour += 1
            send_minute -= 60

       
        pywhatkit.sendwhatmsg(phone_number, message, send_hour, send_minute)
        print(f"WhatsApp message scheduled for {send_hour}:{send_minute}")
    except Exception as e:
        print(f"Error scheduling WhatsApp message: {e}")
else:
    print("Usage: python send_whatsapp.py <phone_number> <message>")