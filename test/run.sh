
#!/bin/bash

#function
execute(){
	program=$1
	./$program < inp/input.txt > out/temp.txt	
	chmod 777 out/temp.txt
	./push out/temp.txt >> out/output.txt	
}

./CoTuongUp2 init initial.txt

# bien dich 2 code
g++ $1 -o p1
g++ $2 -o p2

#copy file template toi input
#copy file dead_template toi dead.txt
cp inp/template.txt inp/input.txt
cp inp/dead_template.txt inp/dead.txt
rm -f out/output.txt
touch out/output.txt
chmod 777 out/output.txt

# chay lien tiep chuong trinh
# p1 di truoc
turn=0
out="NO"
player=0
while [ "$out" = "NO" ]; do
	execute p1
	player=$((1 - player))
	out=$(./CoTuongUp2 edit initial.txt inp/input.txt out/output.txt inp/dead.txt)	
	if [ "$out" = "YES" ]; then
		echo $player
		break
	fi	
	execute p2
	player=$((1 - player))
	out=$(./CoTuongUp2 edit initial.txt inp/input.txt out/output.txt inp/dead.txt)
	if [ "$out" = "YES" ]; then
		echo $player
		break
	fi	
	# 1000 turn thi thoat
	turn=$((turn + 1))
	if [ "$turn" -eq 100 ]; then
		echo $player
		break
	fi
done

