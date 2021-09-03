drop table if exists vehicle;
drop table if exists client;
drop table if exists booking;

create table vehicle (    
    rego varchar(6) not null primary key,    
    model varchar(30) not null,
    year integer not null,  
    odometer integer not null,  
    transmission varchar(20) not null      
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
    start_time datetime not null,  
    return_time datetime not null      
); 

insert into vehicle values ("782GTC", "Fast Car", 1999, 129020, "Manual");
insert into vehicle values ("321WKQ", "Slow Car", 2003, 99826, "Automatic");
insert into vehicle values ("582PPO", "Normal Car", 2012, 80223, "Automatic");