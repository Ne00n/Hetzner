cd Hetzner/
git checkout master
git reset --hard
git pull origin master
for commit in $(git rev-list master)
do
	echo $commit
	git checkout $commit
	php ../parse.php $1
done
