# Getting Started

> [Existing Project](#new-project)

Use these instructions to set-up an exiting project which you are going to work on. 

> [New Project](#new-project)

Use these instructions to create new project. 


## Existing Project

Use these instructions to set-up an exiting project which you are going to work on. 

## Clone the repo

```
git clone git@github.com:moxie-lean/your-theme.git
```

### Install dependencies

`Lean Theme` uses Composer to manage dependencies. Run the following in the project's root directory:

```
composer install && composer update
```

[Download Composer](https://getcomposer.org/download/) first if you don't already have it installed globally.



## New Project

Use these instructions to create new project.

### Clone the repo
To start a new project without the commit history you can run:

```
git clone --depth=1 git@github.com:moxie-lean/lean-theme.git <your-project-name>
```

The `depth=1` tells git to only pull down one commit worth of historical data.

### Install dependencies

`Lean Theme` uses Composer to manage dependencies. Run the following in the project's root directory:

```
composer install && composer update
```

[Download Composer](https://getcomposer.org/download/) first if you don't already have it installed globally.

### Update information

As a bare minimum you should:
 
- Update the theme info in ```style.css```
- Update the constant values in `functions.php` (but not the constant names)
- Search for all occurrences of `LeanNs` and replace them with the top-level namespace you want to use.  
