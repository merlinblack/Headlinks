<?php namespace NigeLib;

class Headlinks {
    private $files = array();
    private $dependencies;
    private $pending = array();

    public function __construct( $dependencies = array() ) {
        $this->dependencies = $dependencies;
    }

    public function addFile( $file ) {
        // Guard against cyclic dependencies
        if( in_array( $file, $this->pending ) === true )
            return $this;
        if( in_array( $file, $this->files ) === true )
            return $this;

        array_push( $this->pending, $file );

        if( isset( $this->dependencies[$file] ) === true ) {
            foreach( $this->dependencies[$file] as $dependency ) {
                $this->addFile( $dependency );
            }
        }

        if( $file[0] != '$' ) {     // Don't actually add virtual dependencies.
            $this->files[] = $file;
        }

        array_pop( $this->pending );
        return $this;
    }

    public function getStyles() {
        $styles = '';
        foreach( $this->files as $file ) {
            $path = pathinfo($file);
            if( $path['extension'] == 'css' ) {
                $filever = $file . '?ts=' . filemtime($file);
                $styles .= "<link rel='stylesheet' href='" . $filever . "'>\n";
            }
        }
        return $styles;
    }

    public function getScripts() {
        $scripts = '';
        foreach( $this->files as $file ) {
            $path = pathinfo($file);
            if( $path['extension'] == 'js' ) {
                $filever = $file . '?ts=' . filemtime($file);
                $scripts .= "<script src='" . $filever . "'></script>\n";
            }
        }
        return $scripts;
    }

    public function __toString() {
        return $this->getStyles() . $this->getScripts();
    }
}

