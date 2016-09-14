

<!-- Start gulpfile.js -->

# Gulp Commands

Run them with ```gulp <command>```, e.g. ```gulp pl:dev```.

## General

> Default task

Runs pl:dev

## Pattern Lab

> pl:generate

Runs Pattern Lab's generate command. This will convert the patterns in the patterns/source folder to the right format, and copy them to the patterns/public folder ready to be viewed. Note this does not compile the CSS from SCSS.

This is a wrapper for Pattern Lab's own ```php core/console --generate``` command.

> pl:watch

Watches for changes in the patterns/source folder and runs pl:generate. Note this does not watch for changes to SCSS files.

This is a wrapper for Pattern Lab's own ```php core/console --watch``` command.

> pl:bs

Fires up the Pattern Lab UI using BrowserSync. Automatically refreshes the browser whenever the patterns are built.

> pl:dev

Fires up the Pattern Lab UI using BrowserSync.

It watches for changes in SCSS and HTML and automatically compiles where necessary and updates the browser. This is the command you want to use when working on patterns.

> patterns:watch

Wrapper for `npm run watch` for the front-end files.

## Lint

> lint

Runs php:lint and all lint tasks for the front-end files.

> php:lint

Validates the PHP according to the standard WordPress rules with some exceptions. These are defined in codesniffer.ruleset.xml.

> view:lint

Wrapper for `npm run lint` for the front-end files.

## Documentation

> docs

Builds this documentation for the Gulp Commands.

<!-- End gulpfile.js -->

