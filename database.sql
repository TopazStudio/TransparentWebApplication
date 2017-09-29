create table transparent_db.blogs
(
	id int(10) unsigned auto_increment
		primary key,
	url varchar(191) not null,
	heading varchar(191) not null,
	content varchar(191) not null,
	topicId int(10) unsigned not null,
	userId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index blogs_topicid_foreign
	on blogs (topicId)
;

create index blogs_userid_foreign
	on blogs (userId)
;

create table transparent_db.comments
(
	id int(10) unsigned auto_increment
		primary key,
	content varchar(191) not null,
	likes int(10) unsigned not null,
	dislikes int(10) unsigned not null,
	topicId int(10) unsigned not null,
	userId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index comments_topicid_foreign
	on comments (topicId)
;

create index comments_userid_foreign
	on comments (userId)
;

create table transparent_db.companies
(
	id int(10) unsigned auto_increment
		primary key,
	name varchar(191) not null,
	businessNo varchar(191) null,
	description varchar(191) not null,
	latitude varchar(191) not null,
	longitude varchar(191) not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

alter table comments
	add constraint comments_topicid_foreign
		foreign key (topicId) references transparent_db.companies (id)
			on delete cascade
;

create table transparent_db.company_related_blogs
(
	id int(10) unsigned auto_increment
		primary key,
	blogId int(10) unsigned not null,
	companyId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint company_related_blogs_blogid_foreign
		foreign key (blogId) references transparent_db.blogs (id)
			on delete cascade,
	constraint company_related_blogs_companyid_foreign
		foreign key (companyId) references transparent_db.companies (id)
			on delete cascade
)
;

create index company_related_blogs_blogid_foreign
	on company_related_blogs (blogId)
;

create index company_related_blogs_companyid_foreign
	on company_related_blogs (companyId)
;

create table transparent_db.company_related_topics
(
	id int(10) unsigned auto_increment
		primary key,
	topicId int(10) unsigned not null,
	companyId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint company_related_topics_companyid_foreign
		foreign key (companyId) references transparent_db.companies (id)
			on delete cascade
)
;

create index company_related_topics_companyid_foreign
	on company_related_topics (companyId)
;

create index company_related_topics_topicid_foreign
	on company_related_topics (topicId)
;

create table transparent_db.documents
(
	id int(10) unsigned auto_increment
		primary key,
	location varchar(191) not null,
	type varchar(191) null,
	size varchar(191) null,
	companyId int(10) unsigned null,
	userId int(10) unsigned null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint documents_companyid_foreign
		foreign key (companyId) references transparent_db.companies (id)
			on delete cascade
)
;

create index documents_companyid_foreign
	on documents (companyId)
;

create index documents_userid_foreign
	on documents (userId)
;

create table transparent_db.migrations
(
	id int(10) unsigned auto_increment
		primary key,
	migration varchar(191) not null,
	batch int not null
)
;

create table transparent_db.password_resets
(
	email varchar(191) not null,
	token varchar(191) not null,
	created_at timestamp null
)
;

create index password_resets_email_index
	on password_resets (email)
;

create table transparent_db.pictures
(
	id int(10) unsigned auto_increment
		primary key,
	location varchar(191) not null,
	picturable_id int(10) unsigned not null,
	picturable_type varchar(191) not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index pictures_picturable_id_picturable_type_index
	on pictures (picturable_id, picturable_type)
;

create table transparent_db.replies
(
	id int(10) unsigned auto_increment
		primary key,
	content varchar(191) not null,
	likes int(10) unsigned default '0' not null,
	dislikes int(10) unsigned default '0' not null,
	commentId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint replies_commentid_foreign
		foreign key (commentId) references transparent_db.comments (id)
			on delete cascade
)
;

create index replies_commentid_foreign
	on replies (commentId)
;

create table transparent_db.reviews
(
	id int(10) unsigned auto_increment
		primary key,
	content text not null,
	likes int not null,
	dislikes int not null,
	companyId int(10) unsigned not null,
	userId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint reviews_companyid_foreign
		foreign key (companyId) references transparent_db.companies (id)
			on delete cascade
)
;

create index reviews_companyid_foreign
	on reviews (companyId)
;

create index reviews_userid_foreign
	on reviews (userId)
;

create table transparent_db.topic_joined_users
(
	id int(10) unsigned auto_increment
		primary key,
	topicId int(10) unsigned not null,
	userId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index topic_joined_users_topicid_foreign
	on topic_joined_users (topicId)
;

create index topic_joined_users_userid_foreign
	on topic_joined_users (userId)
;

create table transparent_db.topics
(
	id int(10) unsigned auto_increment
		primary key,
	description varchar(191) not null,
	likes int(10) unsigned default '0' not null,
	dislikes int(10) unsigned default '0' not null,
	ownerId int(10) unsigned not null,
	created_at timestamp null,
	updated_at timestamp null
)
;

create index topics_ownerid_foreign
	on topics (ownerId)
;

alter table blogs
	add constraint blogs_topicid_foreign
		foreign key (topicId) references transparent_db.topics (id)
			on delete cascade
;

alter table company_related_topics
	add constraint company_related_topics_topicid_foreign
		foreign key (topicId) references transparent_db.topics (id)
			on delete cascade
;

alter table topic_joined_users
	add constraint topic_joined_users_topicid_foreign
		foreign key (topicId) references transparent_db.topics (id)
			on delete cascade
;

create table transparent_db.users
(
	id int(10) unsigned auto_increment
		primary key,
	name varchar(191) not null,
	email varchar(191) not null,
	password varchar(191) not null,
	role varchar(191) not null,
	remember_token varchar(100) null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint users_email_unique
		unique (email)
)
;

alter table blogs
	add constraint blogs_userid_foreign
		foreign key (userId) references transparent_db.users (id)
			on delete cascade
;

alter table comments
	add constraint comments_userid_foreign
		foreign key (userId) references transparent_db.users (id)
			on delete cascade
;

alter table documents
	add constraint documents_userid_foreign
		foreign key (userId) references transparent_db.users (id)
			on delete cascade
;

alter table reviews
	add constraint reviews_userid_foreign
		foreign key (userId) references transparent_db.users (id)
			on delete cascade
;

alter table topic_joined_users
	add constraint topic_joined_users_userid_foreign
		foreign key (userId) references transparent_db.users (id)
			on delete cascade
;

alter table topics
	add constraint topics_ownerid_foreign
		foreign key (ownerId) references transparent_db.users (id)
			on delete cascade
;

