

<!-- Start gulpfile.js -->

# Gulp Commands

## General

> Default task

Runs pl:dev

> dev

Runs styles:dev and js:dev

> watch

Runs styles:watch and js:watch

> lint

Runs styles:lint, js:lint and php:lint

## Pattern Lab

> pl:generate

Runs Pattern Lab's generate command. This will convert the patterns in the patterns/source folder to the right format, and copy them to the patterns/public folder ready to be viewed. Note this does not compile the CSS from SCSS.

This is a wrapper for Pattern Lab's own ```php core/console --generate``` command.

> pl:watch

Watches for changes in the patterns/source folder and runs pl:generate. Note this does not watch for changes to SCSS files.

This is a wrapper for Pattern Lab's own ```php core/console --watch``` command.

> pl:dev

Fires up the Pattern Lab UI using BrowserSync.

It watches for changes in SCSS and HTML and automatically compiles where necessary and updates the browser. This is the command you want to use when working on patterns.

## Styles

> styles:build

Compiles minified version of the CSS and adds cross-browser prefixes.

> styles:dev

Compiles the unminified version of the CSS including sourcemaps. Does not add cross-browser prefixes.

> styles:watch

Watches for changes to SCSS files in patterns/source/_patterns and runs styles:dev.

> styles:collate

Builds the master _styles.scss file by including imports for all *.scss files found in patterns/source/_patterns.

It will import files with the .p1.scss (p1 = priority 1) first, so use this on files with variables or other styles which must be loaded at the top of the compiled CSS file.

> styles:lint

Validates the SCSS according to our rules defined in .sass-lint.yml.

## PHP

> php:lint

Validates the PHP according to the standard WordPress rules with some exceptions. These are defined in codesniffer.ruleset.xml.

## Documentation

> docs

Builds this documentation for the Gulp Commands.

## Javascript

<!-- End gulpfile.js -->

