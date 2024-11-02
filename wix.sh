echo "aca estoy con loan" | cat > "acaEstoy.txt"
cd "webs"
mkdir $1
ls
    cd $1
    echo "<h1>hola, ingresaste al sitio web del dominio '$1'</h1>" | cat > index.php
    mkdir css
    cd css
        mkdir user
            cd user
            echo "" | cat > estilo.css
            cd ..
        mkdir admin
            cd admin
            echo "" | cat > estilo.css
            cd ..
        cd ..
    mkdir img
    cd img
        mkdir avatars
        mkdir buttons
        mkdir products
        mkdir pets
        cd ..
    mkdir js
    cd js
        mkdir validations
        cd validations
            echo "" | cat > login.js
            echo "" | cat > register.js
            cd ..
        mkdir effects
        cd effects
            echo "" | cat > panels.js
            cd ..
        cd ..
    mkdir tpl
    cd tpl
        echo "" | cat > main.tpl
        echo "" | cat > login.tpl
        echo "" | cat > register.tpl
        echo "" | cat > panel.tpl
        echo "" | cat > profile.tpl
        echo "" | cat > crud.tpl
    cd ..

    mkdir php
    cd php
        echo "" | cat > create.php
        echo "" | cat > read.php
        echo "" | cat > update.php
        echo "" | cat > delete.php
        echo "" | cat > dbconnect.php
    cd ..
chmod 755 $1