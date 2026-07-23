#include <ESP32Servo.h>

//======================================
// HC-SR04
//======================================
const int TRIG_PIN = 5;
const int ECHO_PIN = 18;

//======================================
// Servo
//======================================
const int SERVO1_PIN = 12;
const int SERVO2_PIN = 13;

//======================================
// Servo Object
//======================================
Servo servo1;
Servo servo2;

//======================================
// Konstanta
//======================================
const int JARAK_DETEKSI = 30;

const int SERVO_TUTUP = 0;
const int SERVO_BUKA = 90;

const int STEP_DELAY = 3;

//======================================
// Variabel
//======================================
long duration;
float distance;

//======================================
// Setup
//======================================
void setup() {

  Serial.begin(115200);

  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);

  digitalWrite(TRIG_PIN, LOW);

  servo1.attach(SERVO1_PIN);
  servo2.attach(SERVO2_PIN);

  // Posisi awal
  servo1.write(0);
  servo2.write(180);

  Serial.println("Robot Siap...");
}

//======================================
// Servo Buka
//======================================
void bukaServo() {

  for (int i = SERVO_TUTUP; i <= SERVO_BUKA; i++) {

    servo1.write(i);
    servo2.write(180 - i);

    delay(STEP_DELAY);
  }
}

//======================================
// Servo Tutup
//======================================
void tutupServo() {

  for (int i = SERVO_BUKA; i >= SERVO_TUTUP; i--) {

    servo1.write(i);
    servo2.write(180 - i);

    delay(STEP_DELAY);
  }
}

//======================================
// Baca Ultrasonik
//======================================
float bacaJarak() {

  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);

  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);

  digitalWrite(TRIG_PIN, LOW);

  duration = pulseIn(ECHO_PIN, HIGH, 30000);

  if (duration == 0) {
    return 999;
  }

  return duration * 0.0343 / 2;
}

//======================================
// Loop
//======================================
void loop() {

  distance = bacaJarak();

  Serial.print("Jarak : ");
  Serial.print(distance);
  Serial.println(" cm");

  // Ada objek
  if (distance <= JARAK_DETEKSI) {

    Serial.println("Objek Terdeteksi");

    bukaServo();

    Serial.println("Servo Terbuka");

    delay(3000);

    tutupServo();

    Serial.println("Servo Tertutup");

    // Tunggu sebentar agar tidak langsung membaca lagi
    delay(500);
  }

  delay(100);
}