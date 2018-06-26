<?php
/* ************************************************************************** */
/*                                                                            */
/*                 main.php for J06                                           */
/*                 Created on : Fri Mar  7 16:15:49 2014                      */
/*                 Made by : David "Thor" GIRON <thor@42.fr>                  */
/*                                                                            */
/* ************************************************************************** */

require_once 'Vertex.class.php';
require_once 'Triangle.class.php';
require_once 'Vector.class.php';
require_once 'Matrix.class.php';
require_once 'Camera.class.php';
require_once 'Render.class.php';


function makeRepere() {
	$red   = new Color( array( 'red' => 0xff, 'green' => 0   , 'blue' => 0    ) );
	$green = new Color( array( 'red' => 0   , 'green' => 0xff, 'blue' => 0    ) );
	$blue  = new Color( array( 'red' => 0   , 'green' => 0   , 'blue' => 0xff ) );
	$Ox = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'color' => $green ) );
	$X  = new Vertex( array( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'color' => $green ) );
	$Oy = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'color' => $red   ) );
	$Y  = new Vertex( array( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'color' => $red   ) );
	$Oz = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'color' => $blue  ) );
	$Z  = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'color' => $blue  ) );
	return array(
		new Triangle( $Ox, $Ox, $X ),
		new Triangle( $Oy, $Oy, $Y ),
		new Triangle( $Oz, $Oz, $Z )
		);
}

function makeColoredCube( $x, $y, $z, $l ) {
	$red     = new Color( array( 'red' => 0xff, 'green' => 0   , 'blue' => 0    ) );
	$green   = new Color( array( 'red' => 0   , 'green' => 0xff, 'blue' => 0    ) );
	$blue    = new Color( array( 'red' => 0   , 'green' => 0   , 'blue' => 0xff ) );
	$yellow  = new Color( array( 'red' => 0xff, 'green' => 0xff, 'blue' => 0    ) );
	$cyan    = new Color( array( 'red' => 0   , 'green' => 0xff, 'blue' => 0xff ) );
	$magenta = new Color( array( 'red' => 0xff, 'green' => 0   , 'blue' => 0xff ) );
	$white   = new Color( array( 'red' => 0xff, 'green' => 0xff, 'blue' => 0xff ) );
	$grey    = new Color( array( 'red' => 70  , 'green' => 70  , 'blue' => 70   ) );
	$hl = $l / 2.0;
	$a = new Vertex( array( 'x' => $x-$hl, 'y' => $y+$hl, 'z' => $z+$hl, 'color' => $red ) );
	$b = new Vertex( array( 'x' => $x+$hl, 'y' => $y+$hl, 'z' => $z+$hl, 'color' => $green ) );
	$c = new Vertex( array( 'x' => $x+$hl, 'y' => $y+$hl, 'z' => $z-$hl, 'color' => $blue ) );
	$d = new Vertex( array( 'x' => $x-$hl, 'y' => $y+$hl, 'z' => $z-$hl, 'color' => $yellow ) );
	$e = new Vertex( array( 'x' => $x-$hl, 'y' => $y-$hl, 'z' => $z+$hl, 'color' => $magenta ) );
	$f = new Vertex( array( 'x' => $x+$hl, 'y' => $y-$hl, 'z' => $z+$hl, 'color' => $cyan ) );
	$g = new Vertex( array( 'x' => $x+$hl, 'y' => $y-$hl, 'z' => $z-$hl, 'color' => $grey ) );
	$h = new Vertex( array( 'x' => $x-$hl, 'y' => $y-$hl, 'z' => $z-$hl, 'color' => $white ) );
	return array( new Triangle( $a, $c, $b ), new Triangle( $a, $d, $c ),
				  new Triangle( $e, $g, $h ), new Triangle( $e, $f, $g ),
				  new Triangle( $e, $b, $f ), new Triangle( $a, $b, $e ),
				  new Triangle( $d, $g, $c ), new Triangle( $d, $h, $g ),
				  new Triangle( $a, $e, $h ), new Triangle( $a, $h, $d ),
				  new Triangle( $f, $c, $g ), new Triangle( $f, $b, $c )
		);
}

$v  = new Vector( array( 'dest' => new Vertex( array( 'x' => 20.0, 'y' => 20.0, 'z' => 0.0 ) ) ) );
$T  = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $v ) );
$S  = new Matrix( array( 'preset' => Matrix::SCALE, 'scale' => 10.0 ) );
$RY = new Matrix( array( 'preset' => Matrix::RY, 'angle' => M_PI_4 ) );
$RX = new Matrix( array( 'preset' => Matrix::RX, 'angle' => M_PI_4 ) );

$cam = new Camera( array( 'origin' => new Vertex( array( 'x' => 15.0, 'y' => 15.0, 'z' => 80.0 ) ),
						  'orientation' => new Matrix( array( 'preset' => Matrix::RY, 'angle' => M_PI ) ),
						  'width' => 640,
						  'height' => 480,
						  'fov' => 60,
						  'near' => 1.0,
						  'far' => 100.0) );

$renderer = new Render( 640, 480, 'pic.png' );


$origin = New Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
$origin = $cam->watchVertex( $origin );


$repere = makeRepere();
$repere = $S->transformMesh( $repere );
$repere = $cam->watchMesh( $repere );
$renderer->renderMesh( $repere, Render::EDGE );
$renderer->renderVertex( $origin );


$cube = makeColoredCube( 0.0, 0.0, 0.0, 1.0 );
$M = $T->mult( $RX )->mult( $RY )->mult( $S );
$cube = $M->transformMesh( $cube );
$cube = $cam->watchMesh( $cube );
$renderer->renderMesh( $cube, Render::RASTERIZE );


$renderer->develop();

?>
