PRAGMA foreign_keys = ON;
drop table if exists vehicle;
drop table if exists client;
drop table if exists booking;

create table vehicle (    
    rego varchar(6) not null primary key,    
    model varchar(30) not null,
    year integer not null,  
    odometer integer not null,  
    transmission varchar(20) not null,
    bookings integer default 0,
    booking_time integer default 0      
); 

create table client (    
    drivers_license_number integer not null primary key,    
    license_type varchar(10) not null,
    name varchar(80) not null,  
    age integer not null,  
    gender varchar(20) not null     
); 

create table booking (    
    booking_id integer not null primary key autoincrement,    
    vehicle_rego varchar(6) not null REFERENCES vehicle(rego),
    client_drivers_license_number integer not null REFERENCES client(drivers_license_number),  
    start_time date not null,  
    return_time date not null      
); 

insert into vehicle values ("782GTC", "Fast Car", 1999, 129020, "Manual", 0, 0);
insert into vehicle values ("321WKQ", "Slow Car", 2003, 99826, "Automatic", 0, 0);
insert into vehicle values ("582PPO", "Normal Car", 2012, 80223, "Automatic", 0, 0);
insert into vehicle values ("311POG", "Tesla Model X", 2020, 29833, "Automatic", 0, 0);

insert into client values (123456789, "Automatic", "John Smith", 29, "Male");
insert into client values (999999999, "Manual", "Patricia Grey", 92, "Female");
insert into client values (379927326, "Manual", "Greg Apples", 32, "Male");
insert into client values (895875985, "Automatic", "Bobby Reed", 28, "Male");

insert into booking values (null, "782GTC", 123456789, "2008-11-11", "2008-11-17");
insert into booking values (null, "321WKQ", 999999999, "2008-11-11", "2008-11-17");
insert into booking values (null, "582PPO", 379927326, "2008-11-11", "2008-11-17");
insert into booking values (null, "311POG", 895875985, "2008-11-11", "2008-11-17");

