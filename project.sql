drop table Account1 cascade constraints;
drop table Account2 cascade constraints;
drop table CreditCard1 cascade constraints;
drop table CreditCard2 cascade constraints;
drop table Member cascade constraints;
drop table Merchant cascade constraints;
drop table PromotionOffers cascade constraints;
drop table Reward cascade constraints;
drop table Redeems cascade constraints;
drop table Survey cascade constraints;
drop table FillsOut cascade constraints;
drop table Transaction cascade constraints;

create table Account1(
    accountID           varchar(10) primary key,
    pointBalance        integer  not null,
    streetAddress       varchar(100),
    city                varchar(50),
    postalCode          varchar(10),
    country             varchar(50)
);
grant select on Account1 to public;

create table Account2(
    postalCode          varchar(10),
    country             varchar(50),
    provinceState       varchar(50),
    primary key (postalCode, country)
);
grant select on Account2 to public;

create table CreditCard1(
    creditCardID        varchar(10) primary key,
    creditCardNum       char(16) unique not null,
    accountID           varchar(10) not null,
    expirationDate      DATE,
    foreign key (accountID) references Account1(accountID) ON DELETE CASCADE
);
grant select on CreditCard1 to public;

create table CreditCard2(
    creditCardNum       char(16) primary key,
    cardType            varchar(30),
    cardIssuer          varchar(30)
);
grant select on CreditCard2 to public;

create table Member(
    memberID           varchar(10) unique,
    accountID          varchar(10),
    memberName         varchar(50),
    email              varchar(50) unique not null,
    phone              varchar(50) not null, 
    birthDate          date,
    referrerID         varchar(10),
    primary key (memberID, accountID),
    foreign key (accountID) references Account1(accountID),
    foreign key (referrerID) references Member(memberID)      
);
grant select on Member to public;

create table Merchant(
    merchantID       varchar(10) primary key,
    merchantName     varchar(30) not null,
    joinDate         date,
    defaultRate      decimal(6,2) not null
);
grant select on Merchant to public;

create table PromotionOffers(
    promotionID      varchar(10) primary key,
    merchantID       varchar(10),
    promotionRate    decimal(6,2) not null,
    startDate        date,
    endDate          date,
    foreign key (merchantID) references Merchant(merchantID)
);
grant select on PromotionOffers to public;

create table Reward(
    rewardID           varchar(10) primary key,
    pointCost          integer  not null,
    rewardCategory     varchar(30),
    rewardDescription  varchar(100) not null
);
grant select on Reward to public;

create table Redeems(
    rewardID          varchar(10),
    accountID         varchar(10),
    memberID          varchar(10),
    dateTime          timestamp not null,
    primary key (rewardID, accountID, memberID),
    foreign key (rewardID) references Reward(rewardID) ON DELETE CASCADE,
    foreign key (accountID, memberID) references Member(accountID, memberID)       
);
grant select on Redeems to public;

create table Survey(
    surveyID         varchar(10) primary key,
    pointsValue      integer  not null,
    expirationDate   date
);
grant select on Survey to public;

create table FillsOut(
    accountID        varchar(10),
    memberID         varchar(10),
    surveyID         varchar(10),
    dateTime         timestamp not null,
    primary key (accountID, memberID, surveyID),
    foreign key (memberID, accountID) references Member(memberID, accountID),
    foreign key (surveyID) references Survey(surveyID)
);
grant select on FillsOut to public;

create table Transaction(
    transactionID     varchar(10) primary key,
    promotionID       varchar(10),
    merchantID        varchar(10),
    merchantName      varchar(50)     not null,
    accountID         varchar(10)     not null,
    dateTime          timestamp    not null,
    type              varchar(20)     not null,
    pointsValue       integer      not null,
    transactionAmount decimal(6,2) not null,
    foreign key (promotionID) references PromotionOffers(promotionID),
    foreign key (merchantID) references Merchant(merchantID),
    foreign key (accountID) references Account1(accountID)
);
grant select on Transaction to public;

insert all
into Account1 (accountID, pointBalance, streetAddress, city, postalCode, country) values ('A1001', 0, '3308 Ast St.', 'Vancouver', 'V5Z 3E3', 'Canada')
into Account1 (accountID, pointBalance, streetAddress, city, postalCode, country) values ('A1002', 0, '374 Brisdale Dr', 'Brampton', 'L7A 3M5', 'Canada')
into Account1 (accountID, pointBalance, streetAddress, city, postalCode, country) values ('A1003', 0, '500 Kingston Rd', 'Toronto', 'M4L 1V3', 'Canada')
into Account1 (accountID, pointBalance, streetAddress, city, postalCode, country) values ('A1004', 0, '7503 Rue St Denis', 'Montreal', 'H2R 2E7', 'Canada')
into Account1 (accountID, pointBalance, streetAddress, city, postalCode, country) values ('A1005', 0, '3124 Doctors Drive', 'Los Angeles', '90017', 'USA')
select * from dual;

insert all
into Account2 (postalCode, country, provinceState) values ('V5Z 3E3', 'Canada', 'British Columbia')
into Account2 (postalCode, country, provinceState) values ('L7A 3M5', 'Canada', 'Ontario')
into Account2 (postalCode, country, provinceState) values ('M4L 1V3','Canada', 'Ontario')
into Account2 (postalCode, country, provinceState) values ('H2R 2E7','Canada', 'Ontario')
into Account2 (postalCode, country, provinceState) values ('90017', 'USA', 'California')
select * from dual;

insert all
into CreditCard1 (creditCardID, creditCardNum, accountID, expirationDate) values ('C1001', '4147382978379182', 'A1001', DATE '2025-01-01')
into CreditCard1 (creditCardID, creditCardNum, accountID, expirationDate) values ('C1002', '5214231107639819', 'A1002', DATE '2023-03-01')
into CreditCard1 (creditCardID, creditCardNum, accountID, expirationDate) values ('C1003', '5214232637822867', 'A1003', DATE '2022-03-01')
into CreditCard1 (creditCardID, creditCardNum, accountID, expirationDate) values ('C1004', '3413741564427891', 'A1004', DATE '2022-02-01')
into CreditCard1 (creditCardID, creditCardNum, accountID, expirationDate) values ('C1005', '4246315236423180', 'A1005', DATE '2021-01-01')
select * from dual;

insert all
into CreditCard2 (creditCardNum, cardType, cardIssuer) values ('4147382978379182', 'visa', 'Royal Bank of Canada')
into CreditCard2 (creditCardNum, cardType, cardIssuer) values ('5214231107639819', 'visa', 'TD Canada Trust')
into CreditCard2 (creditCardNum, cardType, cardIssuer) values ('5214232637822867', 'mastercard', 'TD Canada Trust')
into CreditCard2 (creditCardNum, cardType, cardIssuer) values ('3413741564427891', 'mastercard', 'Scotia Bank Canada')
into CreditCard2 (creditCardNum, cardType, cardIssuer) values ('4246315236423180', 'visa', 'Bank of America')
select * from dual;

insert all
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1001', 'A1001', 'Florence R.Cummings', 'florence@gmail.com', '647-897-8250', DATE '1982-03-14', null)
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1002', 'A1002', 'Stephanie R. McCarthy', 'stephanie@gmail.com', '514-887-2380', DATE '1961-09-04', null)
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1003', 'A1003', 'Charles M. Freeman','charles@gmail.com', '604-435-5767', DATE '1977-10-07', 'M1002')
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1004', 'A1004', 'Tracy G. Davis', 'tracy@gmail.com', '705-440-7929', DATE '1989-04-15', 'M1003')
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1005', 'A1005', 'Leonard S. Cass', 'leonard@gmail.com', '281-791-2248', DATE '2000-03-13', 'M1001')
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1006', 'A1003', 'Laura W Simmons','coralie.torp@gmail.com', '701-326-3675', DATE '1972-08-20', null)
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1007', 'A1001', 'Justin Smith', 'justinsmith@gmail.com', '281-464-2248', DATE '1992-06-29', null)
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1008', 'A1001', 'John Smith', 'johnsmith@gmail.com', '202-791-2248', DATE '2000-07-27', null)
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1009', 'A1002', 'Alison Liu', 'alison.liu@gmail.com','281-791-2248', DATE '1998-03-13', 'M1007')
into Member (memberID, accountID, memberName, email, phone, birthDate, referrerID) values ('M1010', 'A1004', 'David Barrett', 'david.barrett@gmail.com', '908-992-2248', DATE '1995-06-13', 'M1001')
select * from dual;

insert all
into Merchant (merchantID, merchantName, joinDate, defaultRate) values ('MC1001', 'Lululemon', DATE '2019-12-20', 0.2)
into Merchant (merchantID, merchantName, joinDate, defaultRate) values ('MC1002', 'Starbucks', DATE '2021-01-15', 0.1)
into Merchant (merchantID, merchantName, joinDate, defaultRate) values ('MC1003', 'SportChek', DATE '2020-05-01', 0.8)
into Merchant (merchantID, merchantName, joinDate, defaultRate) values ('MC1004', 'Ikea', DATE '2020-08-01', 1.5)
into Merchant (merchantID, merchantName, joinDate, defaultRate) values ('MC1005', 'Home Depot', DATE '2020-09-01', 0.5)
select * from dual;

insert all
into PromotionOffers (promotionID, merchantID, promotionRate, startDate, endDate) values ('P1001', 'MC1001', 2.0, DATE '2019-12-01', DATE '2021-03-05')
into PromotionOffers (promotionID, merchantID, promotionRate, startDate, endDate) values ('P1002', null, 1.0, DATE '2020-01-01', null)
into PromotionOffers (promotionID, merchantID, promotionRate, startDate, endDate) values ('P1003', 'MC1003', 2.5, DATE '2020-05-15', DATE '2020-12-31')
into PromotionOffers (promotionID, merchantID, promotionRate, startDate, endDate) values ('P1004', 'MC1004', 5.0, DATE '2020-08-01', DATE '2020-08-31')
into PromotionOffers (promotionID, merchantID, promotionRate, startDate, endDate) values ('P1005', 'MC1005', 12.0, DATE '2020-02-02', DATE '2020-02-05')
select * from dual;

insert all 
into Reward (rewardID, pointCost, rewardCategory, rewardDescription) values ('R1001', 5000, 'Gift Card', '$50 Starbucks Card')
into Reward (rewardID, pointCost, rewardCategory, rewardDescription) values ('R1002', 500000, 'Merchandise', 'iPad 64GB')
into Reward (rewardID, pointCost, rewardCategory, rewardDescription) values ('R1003', 1000, 'Gift Card', '10 Starbucks Card')
into Reward (rewardID, pointCost, rewardCategory, rewardDescription) values ('R1004', 500, 'Donation', 'Food Bank $5 Donation')
into Reward (rewardID, pointCost, rewardCategory, rewardDescription) values ('R1005', 25000, 'Travel', 'Domestic Flight Ticket')
select * from dual;

insert all
into Redeems (rewardID, accountID, memberID, dateTime) values ('R1001', 'A1001', 'M1001', timestamp '2020-08-24 13:45:23')
into Redeems (rewardID, accountID, memberID, dateTime) values ('R1003', 'A1002', 'M1002', timestamp '2021-01-16 11:00:00')
into Redeems (rewardID, accountID, memberID, dateTime) values ('R1004', 'A1003', 'M1003', timestamp '2021-01-17 09:37:12')
into Redeems (rewardID, accountID, memberID, dateTime) values ('R1004', 'A1004', 'M1004', timestamp '2021-02-13 04:01:56')
into Redeems (rewardID, accountID, memberID, dateTime) values ('R1001', 'A1005', 'M1005', timestamp '2021-02-21 22:47:41')
select * from dual;

insert all
into Survey (surveyID, pointsValue, expirationDate) values ('S1001', 50, DATE '2021-03-01')
into Survey (surveyID, pointsValue, expirationDate) values ('S1002', 25, DATE '2020-09-01')
into Survey (surveyID, pointsValue, expirationDate) values ('S1003', 10, DATE '2021-05-01')
into Survey (surveyID, pointsValue, expirationDate) values ('S1004', 10, null)
into Survey (surveyID, pointsValue, expirationDate) values ('S1005', 10, DATE '2022-12-31')
select * from dual;

insert all
into FillsOut (accountID, memberID, surveyID, dateTime) values ('A1001', 'M1001', 'S1001', timestamp '2021-02-28 11:00:00')
into FillsOut (accountID, memberID, surveyID, dateTime) values ('A1002', 'M1002', 'S1002', timestamp '2020-01-01 09:43:22')
into FillsOut (accountID, memberID, surveyID, dateTime) values ('A1003', 'M1003', 'S1003', timestamp '2020-06-24 10:15:44')
into FillsOut (accountID, memberID, surveyID, dateTime) values ('A1004', 'M1004', 'S1004', timestamp '2019-03-10 15:30:01')
into FillsOut (accountID, memberID, surveyID, dateTime) values ('A1005', 'M1005', 'S1005', timestamp '2018-09-22 20:21:22')
into FillsOut (accountID, memberID, surveyID, dateTime) values ('A1004', 'M1010', 'S1003', timestamp '2019-11-13 11:13:45')
select * from dual;

insert all
into Transaction (transactionID, promotionID, merchantID, merchantName, accountID, dateTime, type, pointsValue, transactionAmount) values ('T1001', 'P1001', 'MC1001', 'Lululemon', 'A1001', timestamp '2021-02-28 11:00:00', 'refund', -52, -52.00)
into Transaction (transactionID, promotionID, merchantID, merchantName, accountID, dateTime, type, pointsValue, transactionAmount) values ('T1002', null, null, 'A1 Computers', 'A1003', timestamp '2020-12-27 16:23:18', 'purchase', 0, 15.45)
into Transaction (transactionID, promotionID, merchantID, merchantName, accountID, dateTime, type, pointsValue, transactionAmount) values ('T1003', 'P1001', 'MC1003', 'SportChek', 'A1001', timestamp '2021-03-31 12:38:46', 'purchase', 65, 65.47)
into Transaction (transactionID, promotionID, merchantID, merchantName, accountID, dateTime, type, pointsValue, transactionAmount) values ('T1004', 'P1002', 'MC1004', 'Ikea', 'A1001', timestamp '2019-04-03 18:37:00', 'purchase', 320, 320.06)
into Transaction (transactionID, promotionID, merchantID, merchantName, accountID, dateTime, type, pointsValue, transactionAmount) values ('T1005', 'P1003', 'MC1002', 'Starbucks', 'A1005',timestamp '2021-01-30 12:15:00', 'purchase', 6, 5.50)
select * from dual;













