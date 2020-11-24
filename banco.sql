CREATE DATABASE EXPRESSOAPI;

USE EXPRESSOAPI;

CREATE TABLE Client(
    Id INTEGER NOT NULL,
    Email VARCHAR(300) NOT NULL,
    PasswordClient VARCHAR(50) NOT NULL,
    accesstoken VARCHAR(100) NOT NULL,
    Document VARCHAR(20) NOT NULL,
    NameClient VARCHAR(200) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Api(
    Id INTEGER NOT NULL,
    NameApi VARCHAR(50) NOT NULL,
    PRIMARY KEY(Id) 
);

CREATE TABLE ClientApiRequest(
    Id INTEGER NOT NULL,
    ClientId INTEGER NOT NULL,
    DateId DATE NOT NULL,
    UrlId VARCHAR(128) NOT NULL,
    Body VARCHAR(128) NOT NULL,
    ResponseStatus INT NOT NULL,
    ResponseBody VARCHAR(128) NOT NULL,
    PostActions VARCHAR(128) NOT NULL,
    PRIMARY KEY (Id),
    CONSTRAINT FK_ClientApiRequest_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id)
);

CREATE TABLE ClientConfiguration(
    ClientId INTEGER NOT NULL,
    SMTPHost VARCHAR(50) NOT NULL,
    SMTPUsername VARCHAR(300) NOT NULL,
    SMTPPassword VARCHAR(50) NOT NULL,
    SMTPPort INT NOT NULL,
    TrackingEmailTemplate VARCHAR(128),
    TrackingEmailEventTemplate VARCHAR(128),
    CONSTRAINT FK_ClientConfiguration_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id)
);



CREATE TABLE ClientApi(
    ClientId INTEGER NOT NULL,
    ApiId INTEGER NOT NULL,
    Username VARCHAR(300) NOT NULL,
    PasswordClientApi VARCHAR(100) NOT NULL,
    CONSTRAINT FK_ClientApi_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id),
    CONSTRAINT FK_ClientApi_ApiId FOREIGN KEY (ApiId) REFERENCES Api(Id)
);


CREATE TABLE ClientPlan(
    Id INTEGER NOT NULL,
    ClientId INTEGER NOT NULL,
    Name VARCHAR(50) NOT NULL,
    MonthlyValue NUMBER(2) NOT NULL,
    Requestvalue NUMBER(10) NOT NULL,
    ContractedQuantity NUMBER(10) NOT NULL,
    ExtraQuantity NUMBER(10)

);

insert into Client values(1, "dequimdeveloper@gmail.com", "pass1234", "dequim", "dequim", "dequim", "16987654321");

insert into Client values(2, "sigg@gmail.com", "pass4321", "sigg", "sigg", "sigg", "16123456987");

insert into Client values(3, "gid@gmail.com", "5454pass", "gid", "gid", "gid", "16253614987");

insert into Client values(4, "blaublau@gmail.com", "420420", "blaublau", "blaublau", "blaublau", "16253614987");



insert into ClientConfiguration values(1, "RTE", "rodonaves@rodonaves.com.br", "rodo1234", 8, "rodonaves@rodonaves.com.br", "rodonaves@rodonaves.com.br");

insert into ClientConfiguration values(2, "JAMEF", "jamef@jamef.com.br", "jamef1234", 8, "jamef@jamef.com.br", "jamef@jamef.com.br");

insert into ClientConfiguration values(3, "GBC", "gbc@gbc.com.br", "gbc234", 8, "gbc@gbc.com.br", "gbc@gbc.com.br");

insert into ClientConfiguration values(4, "ABC", "abc@abc.com.br", "abc1234", 8, "abc@abc.com.br", "abc@abc.com.br");