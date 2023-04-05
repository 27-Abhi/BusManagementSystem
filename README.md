
# Bus-management-system

The goal of the bus management system is to offer a systematic method for managing the depot admin, drivers, and conductors.

The Depot administrator can access all the data, add drivers and conductors, and allocate them trips thanks to the bus management system. The bus conductor can enter the revenue generated from each trip while also purchasing tickets for passengers. The driver can input the actual time of departure and arrival as well as the amount of fuel used.

As a result, the Bus Management system makes it simple to operate and administer the bus transportation service.


## Database Design

- BUS: Each bus will have a unique bus number
- ADMIN: The depot administrator can add new conductors/drivers by assigning them their credentials, which include the Conductor/driver ID and password. The administrator can also assign trips. The bus number, source, destination, scheduled arrival, departure, conductor ID, and driver ID must all be entered by the administrator. The trip number, which is the primary key, is auto generated.
- CONDUCTOR: When the conductor logs in, he can see the trip number he was assigned, as well as the bus number and journey date. The conductor can purchase tickets for the passenger by entering the passenger's mobile number, the source, the destination, the price, and the trip number. A one-of-a-kind ticket id will be generated. The conductor can enter trip details such as revenue generated and number of tickets sold.
- DRIVER: Similarly When the driver logs in, he can see the trip number, as well as the bus number and trip date. The driver can enter trip information such as fuel consumed, actual arrival and departure times, and kilometres driven.



## Run Locally

- Clone the project

```bash
  git clone https://github.com/27-Abhi/BusManagementSystem.git
```
- Place the project in Xampp>htdocs folder

- Import the db file into phpmyadmin

- Run the project via localhost


## Authors

- [@27-abhi](https://github.com/27-Abhi)
- [@Navin-Morajkar](https://www.github.com/Navin-Morajkar)



This project was done as a part of our college project for DBMS 
