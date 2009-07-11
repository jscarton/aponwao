install: all
		mkdir /usr/share/aponwao-tools
		cp aponwao-create 		/usr/share/aponwao-tools/
		cp aponwao-developer 	/usr/share/aponwao-tools/
		cp aponwao-export 		/usr/share/aponwao-tools/
		cp aponwao-propel 		/usr/share/aponwao-tools/
		cp aponwaophp.tar.gz	/usr/share/aponwao-tools/
		cp README				/usr/share/aponwao-tools/
		cp gpl-3.0.txt			/usr/share/aponwao-tools/		
		ln -s /usr/share/aponwao-tools/aponwao-create		/usr/bin/aponwao-create	
		ln -s /usr/share/aponwao-tools/aponwao-developer	/usr/bin/aponwao-developer
		ln -s /usr/share/aponwao-tools/aponwao-export		/usr/bin/aponwao-export
		ln -s /usr/share/aponwao-tools/aponwao-propel		/usr/bin/aponwao-propel
uninstall: clean
		rm -f /usr/bin/aponwao-create	
		rm -f /usr/bin/aponwao-developer
		rm -f /usr/bin/aponwao-export
		rm -f /usr/bin/aponwao-propel
		rm -f -R /usr/share/aponwao-tools/