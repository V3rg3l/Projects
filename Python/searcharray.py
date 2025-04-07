list = []
print("To stop enter 0: ")
while True:
    num = int(input())
    if num==0:
        break
    list.append(num)
print("The list has numbers: ", list)
item = int(input("Enter number to search  in the list: "))
found = False
for v in range (len(list)):
    if list[v]==item:
        found = True
        print(item, "was found in the list at index ", v)
        break
    else:
        print(item, "was not found in the list")