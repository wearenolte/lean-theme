# Frontend folder for the Lean Theme
## Powered with Taildwind CSS + SCSS + Parcel

Frontend folder for use with [The Lean Theme](https://github.com/wearenolte/lean-theme)

UI Component development using an hibrid approach with Tailwind CSS and SCSS.

Buils system: Parcel

## Installation
`yarn`

## Developent Build
`yarn start`

**Important Note**:

If you change Tailwind config file, then add a change to the postcss config file so that Parcel recognizes the change and build the CSS file.

ie:
add a console.log('hello') in line 19 of postcss.cinfig.js

## Production Build
`yarn build`

**Important Note**:

The build process purges the CSS. This means that looks in all the PHP files and removes the CSS classes that are not in those files. This reduces the final CSS file size incredibly!