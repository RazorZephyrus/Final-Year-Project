additional Table :

asrama
id, uuid, title, deskripsi, lokasi;

room_type
id, uuid, title, deskripsi;

room
id, uuid, title, room_type_id, asrama_id;

room_fasilitas
id, uuid, room_id, fasilitas_id;

fasilitas
id, uuid, title, deskripsi;

booking
id, uuid, room_id, user_id, start_date, end_date;

payment
id, uuid, ammount, booking_id, status, approve_date;


run sh start.sh untuk menjalankan program fresh;