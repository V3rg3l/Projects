#include<iostream.h>
#include<conio.h>
#include<stdio.h>
#include<string.h>
#include<stdlib.h>

void registerDetails(char name[], char program[], char address[], char age[], char contact[], char religion[]) {
	cout<<"************REGISTER USER************"<<endl;
	cout<<"Name: ";
	gets(name);

	cout<<"Program: ";
	gets(program);

	cout<<"Address: ";
	gets(address);

	cout<<"Age: ";
	gets(age);

	cout<<"Contact Number: ";
	gets(contact);

	cout<<"Religion: ";
	gets(religion);
}

void displayDetails(char name[], char program[], char address[], char age[], char contact[], char religion[]) {
	cout<<"************VIEW INFORMATION************"<<endl;
	cout<<"Name: "<<name<<endl;
	cout<<"Program: "<<program<<endl;
	cout<<"Address: "<<address<<endl;
	cout<<"Age: "<<age<<endl;
	cout<<"Contact Number: "<<contact<<endl;
	cout<<"Religion: "<<religion<<endl;
}

void main() {
	clrscr();
	char name[50], program[50], address[100], age[50], contact[100], religion[30];
	int option;

	selection:
	cout<<"************MENU************"<<endl;

	cout<<"[1] - Register"<<endl;
	cout<<"[2] - View"<<endl;
	cout<<"[3] - Exit"<<endl;

	cout<<"****************************"<<endl;
	cout<<"Option: ";
	cin>>option;
	clrscr();

	switch(option) {
		case 1:
		registerDetails(name, program, address, age, contact, religion);
		getch();
		clrscr();
		goto selection;

		case 2:
		displayDetails(name, program, address, age, contact, religion);
		getch();
		clrscr();
		goto selection;

		case 3:
		cout<<"Program Terminated"<<endl;
	}
	getch();
}
