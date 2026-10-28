#!/usr/bin/env node
import { cp, mkdir } from 'node:fs/promises';
import { existsSync } from 'node:fs';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve( dirname( fileURLToPath( import.meta.url ) ), '..' );
const nm   = resolve( root, 'node_modules' );

const jobs = [
  [ `${ nm }/materialize-css/dist/js/materialize.min.js`,                `${ root }/assets/js/materialize.min.js` ],
  [ `${ nm }/jquery-match-height/dist/jquery.matchHeight-min.js`,        `${ root }/assets/js/jquery.matchHeight-min.js` ],
  [ `${ nm }/materialize-css/dist/fonts/roboto`,                         `${ root }/assets/fonts/roboto` ],
];

for ( const [ src, dest ] of jobs ) {
  if ( ! existsSync( src ) ) {
    console.warn( `[copy-lib] skip (not found): ${ src }` );
    continue;
  }
  await mkdir( dirname( dest ), { recursive: true } );
  await cp( src, dest, { recursive: true, force: true } );
  console.log( `[copy-lib] copied ${ src } -> ${ dest }` );
}
