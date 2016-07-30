#!/bin/bash

echo ""
echo "Setting up patternlab..."
echo ""

cd vendor/pattern-lab/edition-twig-standard

if [ ! -f config/config.yml ]; then
  echo ""
  echo "Creating config.yml..."
  cat > config/config.yml << EOF
exportDir: ../../../patterns/export
publicDir: ../../../patterns/public
sourceDir: ../../../patterns/source
EOF
fi

echo ""
echo "Install Composer dependencies..."
composer install

if [ ! "$(ls -A ../../../patterns/source)" ]; then
  echo ""
  echo "Installing the starter kit..."
  php core/console --starterkit --install moxie-lean/patternlab-starterkit-twig
fi

echo ""
echo "Patternlab set-up complete!"
echo ""
