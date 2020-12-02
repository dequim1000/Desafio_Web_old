CREATE DATABASE EXPRESSOAPI;

USE EXPRESSOAPI;

CREATE TABLE Client(
    Id INTEGER NOT NULL,
    Email VARCHAR(300) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    acesstoken VARCHAR(100) NOT NULL,
    Document VARCHAR(20) NOT NULL,
    Name VARCHAR(200) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Api(
    Id INTEGER NOT NULL,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY(Id) 
);

CREATE TABLE ClientApi(
    ClientId INTEGER NOT NULL,
    ApiId INTEGER NOT NULL,
    Username VARCHAR(300) NOT NULL,
    Password VARCHAR(100) NOT NULL,
    PRIMARY KEY (ClientId, ApiId),
    CONSTRAINT FK_ClientApi_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id),
    CONSTRAINT FK_ClientApi_ApiId FOREIGN KEY (ApiId) REFERENCES Api(Id)
);

CREATE TABLE ClientConfiguration(
    ClientId INTEGER NOT NULL,
    SMTPHost VARCHAR(50) NOT NULL,
    SMTPUsername VARCHAR(300) NOT NULL,
    SMTPPassword VARCHAR(50) NOT NULL,
    SMTPPort INT NOT NULL,
    TrackingEmailTemplate VARCHAR(300),
    TrackingEmailEventTemplate VARCHAR(300),
    PRIMARY KEY (ClientId),
    CONSTRAINT FK_ClientConfiguration_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id)
);

CREATE TABLE Planx(
    Id INTEGER NOT NULL,
    Name VARCHAR(50) NOT NULL,
    RequestQuantity INT,
    Price DECIMAL(10,2),
    PRIMARY KEY(Id)
);

CREATE TABLE ClientPlan(
    ClientId INTEGER NOT NULL,
    PlanId INTEGER NOT NULL,
    PRIMARY KEY(ClientId, PlanId),
    CONSTRAINT FK_ClientPlan_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id),
    CONSTRAINT FK_ClientPlan_PlanId FOREIGN KEY (PlanId) REFERENCES Planx(Id)
);

CREATE TABLE ClientApiRequest(
    Id INTEGER NOT NULL,
    ClientId INTEGER NOT NULL,
    PlanId INTEGER NOT NULL,
    DtRequest DATE NOT NULL,
    Url VARCHAR(300) NOT NULL,
    Body VARCHAR(300) NOT NULL,
    ResponseStatus INT NOT NULL,
    ResponseBody VARCHAR(300) NOT NULL,
    PostActions VARCHAR(300) NOT NULL,
    PRIMARY KEY (Id),
    CONSTRAINT FK_ClientApiRequest_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id),
    CONSTRAINT FK_ClientApiRequest_PlanId FOREIGN KEY (PlanId) REFERENCES Planx(Id)
);

CREATE TABLE ClientPlanHistoy(
    Id INTEGER NOT NULL,
    ClientId INTEGER NOT NULL,
    PlanId INTEGER NOT NULL,
    DtStar DATE,
    DtEnd DATE,
    PRIMARY KEY (Id),
    CONSTRAINT FK_ClientPlanHistoy_ClientId FOREIGN KEY (ClientId) REFERENCES Client(Id),
    CONSTRAINT FK_ClientPlanHistoy_PlanId FOREIGN KEY (PlanId) REFERENCES Planx(Id)
);










insert into Client values(1, "dequimdeveloper@gmail.com", "pass1234", "dequim", "dequim", "dequim", "16987654321");

insert into Client values(2, "sigg@gmail.com", "pass4321", "sigg", "sigg", "sigg", "16123456987");

insert into Client values(3, "gid@gmail.com", "5454pass", "gid", "gid", "gid", "16253614987");

insert into Client values(4, "blaublau@gmail.com", "420420", "blaublau", "blaublau", "blaublau", "16253614987");



insert into ClientConfiguration values(1, "RTE", "rodonaves@rodonaves.com.br", "rodo1234", 8, "rodonaves@rodonaves.com.br", "rodonaves@rodonaves.com.br");

insert into ClientConfiguration values(2, "JAMEF", "jamef@jamef.com.br", "jamef1234", 8, "jamef@jamef.com.br", "jamef@jamef.com.br");

insert into ClientConfiguration values(3, "GBC", "gbc@gbc.com.br", "gbc234", 8, "gbc@gbc.com.br", "gbc@gbc.com.br");

insert into ClientConfiguration values(4, "ABC", "abc@abc.com.br", "abc1234", 8, "abc@abc.com.br", "abc@abc.com.br");

insert into ClientPlan values(1, 1, "SMS", 500.00, 0.20, 100, 20); 



insert into Client values(1, "dequimdeveloper@gmail.com", "pass1234", "dequim", "dequim", "dequim", "16987654321");
insert into Api values(1, "ApiDequim");
insert into ClientApiRequest values (1, 1, "26/06/2001", "www.dequim.com.br", "dequim", "statusAproved", "bodyDequim", "PostDequim");
insert into ClientConfiguration values(1, "RTE", "rodonaves@rodonaves.com.br", "rodo1234", 8, "rodonaves@rodonaves.com.br", "rodonaves@rodonaves.com.br");
insert into ClientApi values(1,1,"Dequim", "pass1234");

insert into Client values(2, "sigg@gmail.com", "pass4321", "sigg", "sigg", "sigg", "16123456987");
insert into Api values(2, "Apisigg");
insert into ClientApiRequest values (2, 2, "13/08/2010", "www.sigg.com.br", "sigg", "statusAproved", "bodysigg", "Postsigg");
insert into ClientConfiguration values(2, "DELE", "Delefrati", "Dele1234", 3, "Delefrati@delefrati.com.br", "delefrati@delefrati.com.br");
insert into ClientApi values(2,2,"sigg", "pass4321");

insert into Client values(3, "gid@gmail.com", "5454pass", "gid", "gid", "gid", "16253614987");
insert into Api values(3, "Apigid");
insert into ClientApiRequest values (3, 3, "30/04/1989", "www.gid.com.br", "gid", "statusAproved", "bodygid", "Postgid");
insert into ClientConfiguration values(3, "TNT", "tnt", "rodo1234", 2, "tnt@tnt.com.br", "tnt@tnt.com.br");
insert into ClientApi values(3,3,"gid", "5454pass");

insert into Client values(4, "blaublau@gmail.com", "420420", "blaublau", "blaublau", "blaublau", "16253614987");
insert into Api values(4, "Apiblaublau");
insert into ClientApiRequest values (4, 4, "04/02/2020", "www.blaublau.com.br", "blaublau", "statusAproved", "bodyblaublau", "Postblaublau");
insert into ClientConfiguration values(4, "Sedex", "Sedex", "Sedex1234", 5, "Sedex@sedex.com.br", "Sedex@sedex.com.br");
insert into ClientApi values(4,4,"blaublau", "420ger");

insert into ClientConfiguration values(2, "JAMEF", "jamef@jamef.com.br", "jamef1234", 8, "jamef@jamef.com.br", "jamef@jamef.com.br");

insert into ClientConfiguration values(3, "GBC", "gbc@gbc.com.br", "gbc234", 8, "gbc@gbc.com.br", "gbc@gbc.com.br");

insert into ClientConfiguration values(4, "ABC", "abc@abc.com.br", "abc1234", 8, "abc@abc.com.br", "abc@abc.com.br");

insert into ClientPlan values(1, 1, "SMS", 500.00, 0.20, 100, 20); 
insert into ClientPlan values(2, 1, "CHAMADAS", 1000.00, 0.25, 150, 30); 
insert into ClientPlan values(3, 2, "SMS", 1000.00, 0.25, 150, 30); 


/*SELECTS*/


/*SELECT PARA MONTAR GRAFICO ROSQUINHA E A TABELA RESUMO*/
SELECT cp.ClientId, cp.NamePlan, cp.MonthlyValue, cp.Requestvalue, cp.ContractedQuantity, cp.ExtraQuantity, count(cpr.id) as "utilizados", ((cp.ContractedQuantity + cp.ExtraQuantity) - count(cpr.id)) as "restantes"
	FROM ClientPlan as cp
    JOIN ClientApiRequest as cpr
    ON cp.id = cpr.PlanId
    And cp.ClientId = cpr.ClientId
	WHERE cpr.ClientId = "1"
    group by cpr.PlanId
;

/*SELECT PARA MONTAR GRAFICO ROSQUINHA E A TABELA RESUMO*/
SELECT cp.ClientId, cp.NamePlan, cp.MonthlyValue, cp.Requestvalue, cp.ContractedQuantity, cp.ExtraQuantity, count(cpr.id) as "utilizados", ((cp.ContractedQuantity + cp.ExtraQuantity) - count(cpr.id)) as "restantes"
	FROM ClientPlan as cp
	JOIN ClientApiRequest as cpr
    ON cp.id = cpr.PlanId
		And cp.ClientId = cpr.ClientId
	WHERE cpr.ClientId = "1"
		And Month(cpr.dt_request) = month(sysdate())
    group by cpr.PlanId
;

/*SELECT PARA MONTAR GRAFICO TABELA E A TABELA RESUMO*/
SELECT cp.ClientId, cp.NamePlan, count(cpr.id) as "utilizados", dayofweek(dt_request)
	FROM ClientPlan as cp
	JOIN ClientApiRequest as cpr
    ON cp.id = cpr.PlanId
		And cp.ClientId = cpr.ClientId
	WHERE cpr.ClientId = "1"
		And Month(cpr.dt_request) = month(sysdate())
    group by cpr.PlanId, cpr.dt_request
;