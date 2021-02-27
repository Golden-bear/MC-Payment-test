lh=int(input("array length:"))
num=[]
for i in range (lh):
    temp=int(input("insert number: "))
    num.append(temp)

print("your array: ",num)

target=int(input("target number: "))
data=False
for i in range (len(num)):
    counter=target-num[i]
    for j in range (i+1,len(num)):
        temp=counter-num[j]
        if temp==0:
            print("index get:[{}]and[{}]".format(i,j))
            data=True
            break
    if data==True:
        break
    if i==len(num)-1 :
        print ("index no found")
