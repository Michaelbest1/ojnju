CFLAGS=-g -Wall
CC=g++

all: judged.cc
	${CC} ${CFLAGS} -c -I/usr/local/mysql/include/mysql -I/usr/include/mysql  judged.cc
	${CC} ${CFLAGS} -o judged judged.o -L/usr/local/mysql/lib/mysql -L/usr/lib/mysql  -lmysqlclient
