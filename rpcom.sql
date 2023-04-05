CREATE TABLE repairperson
(
  psid   CHAR(5)  NOT NULL,
  psname VARCHAR(50) NULL    ,
  psphone VARCHAR(10) NULL    ,
  psstatus VARCHAR(50) NULL    ,
  psdate  VARCHAR(50) NULL,
  PRIMARY KEY (psid)
);

CREATE TABLE repairman
(
  mid  CHAR(5)  NOT NULL,
  mname VARCHAR(50) NULL    ,
  mphone VARCHAR(10) NULL    ,
  mstatus VARCHAR(50) NULL    ,
  mdate  VARCHAR(50) NULL,
  PRIMARY KEY (mid)
);

CREATE TABLE repairworkschedule
(
  wsid  CHAR(5)  NOT NULL,
  wsname  VARCHAR(50) NULL    ,
  wslist VARCHAR(255) NULL    ,
  wsdate  VARCHAR(50) NULL,
  ivtrid  CHAR(5)  NOT NULL,
  ssid  CHAR(5)  NOT NULL,
  mid  CHAR(5)  NOT NULL,
  psid   CHAR(5)  NOT NULL,
  PRIMARY KEY (wsid) 
);

CREATE TABLE repairstatus
(
  ssid  CHAR(5)  NOT NULL,
  sstatus VARCHAR(50) NULL    ,
  ssdetail VARCHAR(255) NULL    ,
  ssdate  VARCHAR(50) NULL,
  PRIMARY KEY (ssid)
);

CREATE TABLE repaircategory
(
  ctgrid  CHAR(5)  NOT NULL,
  ctgrname  VARCHAR(50) NULL    ,
     PRIMARY KEY (ctgrid)
);

CREATE TABLE repairinventory
(
 ivtrid  CHAR(5)  NOT NULL,
 ivtrname  VARCHAR(50) NULL    ,
 ivtritem  CHAR(5)  NULL    ,
 ivtrprice VARCHAR(100) NULL    ,
 ctgrid  CHAR(5)  NOT NULL,
  PRIMARY KEY ( ivtrid)
);

ALTER TABLE  repairworkschedule
  ADD CONSTRAINT FK__repairinventory_TO_repairworkschedule
    FOREIGN KEY (ivtrid)
    REFERENCES repairinventory (ivtrid);

ALTER TABLE  repairworkschedule
  ADD CONSTRAINT FK__repairstatus_TO_repairworkschedule
    FOREIGN KEY (ssid)
    REFERENCES repairstatus (ssid);

ALTER TABLE  repairworkschedule
  ADD CONSTRAINT FK__repairman_TO_repairworkschedule
    FOREIGN KEY (mid)
    REFERENCES repairman (mid);
    
ALTER TABLE  repairworkschedule
  ADD CONSTRAINT FK__repairperson_TO_repairworkschedule
    FOREIGN KEY (psid)
    REFERENCES repairperson (psid);
    
 ALTER TABLE repairinventory
  ADD CONSTRAINT FK__repaircategory_TO_repairinventory
    FOREIGN KEY (ctgrid)
    REFERENCES repaircategory(ctgrid);   
    