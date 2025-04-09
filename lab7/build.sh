#!/bim.bash

path=""
if [ "$0" = "./test.sh" ]; then
  path=""
elif [ "$0" = "./lab7/test.sh" ]; then
  path="lab7/"
else 
  echo "error: invalid root path"
  exit 1
fi

# TODO : write prefix
cp index.html login.php logout.php tables.sql /opt/lampp/htdocs/petru/
# TODO MAKE DATABASE XAMPP WORK, MAKE LOGIN LOGOUT PAGES FAST
