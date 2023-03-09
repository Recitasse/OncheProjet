#!/bin/bash

current_directory=$(pwd)
user=$USER
firefox_path=$(which firefox)
nom_term="Langue"

echo -e "Création du raccourci.\n"
sleep 1

#Création du .desktop
echo "[Desktop Entry]" > /home/${user}/Desktop/Langue.desktop
echo "Encoding=UTF-8" >> /home/${user}/Desktop/Langue.desktop
echo "Version=1.0" >> /home/${user}/Desktop/Langue.desktop
echo "Type=Application" >> /home/${user}/Desktop/Langue.desktop
echo "Terminal=true" >> /home/${user}/Desktop/Langue.desktop
echo "Exec=gnome-terminal --title '${USER}-${nom_term}' --command 'bash -c ${current_directory}/langue.sh'" >> /home/${user}/Desktop/Langue.desktop
echo "Name=Langue" >> /home/${user}/Desktop/Langue.desktop
echo "Icon=${current_directory}/www/anglais.png" >> /home/${user}/Desktop/Langue.desktop
echo "Categories=Application" >> /home/${user}/Desktop/Langue.desktop
echo "Comment=Application permettant de contrôler le drone" >> /home/${user}/Desktop/Langue.desktop

chmod a+rx /home/${user}/Desktop/Langue.desktop
sudo chmod 755 /home/${user}/Desktop/Langue.desktop
gio set /home/${user}/Desktop/Langue.desktop metadata::trusted true

echo -e "\033[32m\033[1m✔  Raccourci installé ! \033[0m\033[0m"

# On renome le terminal
echo -e "Vérification des logiciels et packages.\n"
#On regarde si les principaux programmes sont bien installés

#On regarde pour mysql
if ! dpkg-query -W -f='${Status}' mysql-server 2>/dev/null | grep -q "ok installed"; then
  echo -e "\033[31m\033[1m❌  MySQL n'est pas installé ! \033[0m\033[0m"
  sudo apt-get update
  sudo apt-get install mysql-server
  sudo mysql_
  echo -e "\033[32m\033[1m✔  MySQL installé ! \033[0m\033[0m"
  mysql_version=$(mysql --version)
  echo "      Version : ${mysql_version}"
else
  echo -e "\033[32m\033[1m✔  MySQL installé ! \033[0m\033[0m"
fi

sleep 1

# Création de l'utilisateur langue
echo "Création de l'utilisateur:"
sudo mysql -u root -e "CREATE user 'langue'@'localhost' Identified by 'blondinChad1#';"
sudo mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'langue'@'localhost';"
echo -e "\033[32m\033[1m✔  Utilisateur crée ! \033[0m\033[0m"
sleep 1

# Pour apache2
if ! dpkg-query -W -f='${Status}' apache2 2>/dev/null | grep -q "ok installed"; then
  echo -e "\033[31m\033[1m❌  Apache2 n'est pas installé ! \033[0m\033[0m"
  sudo apt-get update
  sudo apt-get install apache2
  
  #Configuration du server Apache
  echo -e "\033[32m\033[1m✔  Apache2 installé ! \033[0m\033[0m"
  apache2_version=$(apache2 -v | grep "Server version" | cut -d/ -f2 | awk '{print $1}')
  echo "      Version : ${apache2_version}"
  echo -e "      \033[33mConfiguration actuelle du par feu :.\033[0m"
  sudo ufw status

else
  echo -e "\033[32m\033[1m✔  Apache2 installé ! \033[0m\033[0m"
  apache2_version=$(apache2 -v | grep "Server version" | cut -d/ -f2 | awk '{print $1}')
  echo "      Version : ${apache2_version}"
  echo -e "      \033[33mConfiguration actuelle du par feu :\033[0m"
  sudo ufw status
fi
sleep 2
vm="/etc/apache2/apache2.conf"

# Si on ne l'a pas déjà ajouter
if grep -q -v "DocumentRoot /home/raphael/Desktop/Langue/www" /etc/apache2/apache2.conf; then
   # on regarde le dns et l'ip du site
   DNS="/etc/hosts"
   dns_nom="langue.apprendre"
   dns_val="127.1.1.20"
   if ! grep -q "${dns_nom}" "${DNS}"; then
     sudo sh -c "echo '"${dns_val}	${dns_nom}" >> "${DNS}"'"
   fi
   # On l'ajoute à la configuration d'apache

   # Autorisation d'accès à ce seul pc.
   ip=$(hostname -I | cut -c 1-12)

   if ! grep -q "SeverName ${vm_ip}" "${vm}"; then
     sudo bash -c "echo '# Server langue' >> '${vm}'"
     sudo bash -c "echo '<VirtualHost ${dns_val}:80>' >> '${vm}'"
     sudo bash -c "echo '   ServerName langue.ms' >> '${vm}'"
     sudo bash -c "echo '   DocumentRoot ${current_directory}/www' >> '${vm}'"
     sudo bash -c "echo '   <Directory ${current_directory}/www>' >> '${vm}'"
     sudo bash -c "echo '      Require ip ${ip}' >> '${vm}'"
     sudo bash -c "echo '      Options Indexes FollowSymLinks' >> '${vm}'"
     sudo bash -c "echo '      AllowOverride None' >> '${vm}'"
     sudo bash -c "echo '      Require all granted' >> '${vm}'"
     sudo bash -c "echo '   </Directory>' >> '${vm}'"
     sudo bash -c "echo '</VirtualHost>' >> '${vm}'"
  else
     echo -e "\033[32m\033[1m✔\033[0m Configuration apache2 déjà effectuée.\033[0m"
  fi
  echo -e "\033[32m\033[1m✔\033[0m Configuration apache2 terminée.\033[0m\n"
  sudo systemctl reload apache2
fi

sleep 2

#Création du launcher
echo -e "Création du launcher: \n"
echo "sudo systemctl start mysql" > ${current_directory}/langue.sh
echo "sudo systemctl start apache2" >> ${current_directory}/langue.sh
echo "firefox -new-window http://langue.ms" >> ${current_directory}/langue.sh
echo -e "\033[32m\033[1m✔  Raccourci créé ! \033[0m\033[0m \n"
echo -e "\033[32m\033[1mInstallation terminée ! \033[0m\033[0m"
sh langue.sh
sleep 2
exit


