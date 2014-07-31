#
# Table structure for table 'tx_indieweb_domain_model_webmention'
#
CREATE TABLE tx_indieweb_domain_model_webmention (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	source varchar(255) DEFAULT '' NOT NULL,
	target varchar(255) DEFAULT '' NOT NULL,
	data text DEFAULT '' NOT NULL,
	processed datetime,
	valid tinyint(4) unsigned DEFAULT '0' NOT NULL,
	
	author_name tinytext,
	author_profile tinytext,
	author_avatar tinytext,
	entry_name tinytext,
	entry_summary text,
	entry_value tinytext,
	entry_content text,
	entry_published datetime,
	entry_updated datetime,
	entry_url tinytext,
	context text,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);
