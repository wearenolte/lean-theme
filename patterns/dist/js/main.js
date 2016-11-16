'use strict';

// First require the base components
require.context( 'atoms/global/base', true, /^\.\/.*\.scss/ );

// Then all atoms, molecules, etc
require.context( 'atoms', true, /^\.\/.*\.scss/ );
require.context( 'molecules', true, /^\.\/.*\.scss/ );
require.context( 'organisms', true, /^\.\/.*\.scss/ );
require.context( 'templates', true, /^\.\/.*\.scss/ );

require( 'templates/layouts/site' )();
