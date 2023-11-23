</main>

<footer id="page-footer">

    <div id="logos">
        <img src="./assets/svg/logos/01.svg" alt="01" />
        <img src="./assets/svg/logos/02.svg" alt="02" />
        <img src="./assets/svg/logos/03.svg" alt="03" />
        <img src="./assets/svg/logos/09.svg" alt="08" />

        <img src="./assets/svg/logos/04.svg" alt="04" />
        <img src="./assets/svg/logos/05.svg" alt="04" />
        <img src="./assets/svg/logos/06.svg" alt="06" />
        <img src="./assets/svg/logos/07.svg" alt="07" />
        <img src="./assets/svg/logos/08.svg" alt="08" />
    </div>

    <div id="imprint-content">
        <?php include'snippets/imprint.php';?>
    </div>

    <div id="imprint-menu">
        <div id="imprint-link"class="imprint-item">
            Imprint
        </div>
        <div class="imprint-item">
            <a href="https://sonicacts.com/policy" target="_blank">Privacy Policy</a>
        </div>
        <div class="imprint-item">
            <a href="https://sonicacts.com/cookies" target="_blank">Cookies</a>
        </div>
    </div>

</footer>


<script src="./assets/js/jquery-3.6.0.min.js?<?php echo filemtime('./assets/js/jquery-3.6.0.min.js');?>" /></script>
<script src="./assets/js/plugins.js?<?php echo filemtime('./assets/js/main.js');?>" /></script>
<script src="./assets/js/main.js?<?php echo filemtime('./assets/js/main.js');?>" /></script>


		<script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>

		<script type="importmap">
			{
				"imports": {
					"three": "./assets/js/build/three.module.js",
					"three/addons/": "./assets/js/jsm/"
				}
			}
		</script>

		<script type="module">

			import * as THREE from 'three';

			//import Stats from 'three/addons/libs/stats.module.js';


            $(".normal-image").each(function(){

    			let container, stats, loader;

    			let camera, scene, renderer;

    			let mesh;

    			let directionalLight, pointLight, ambientLight;

    			let mouseX = 0;
    			let mouseY = 0;

    			let targetX = 0;
    			let targetY = 0;

    			const windowHalfX = window.innerWidth / 2;
    			const windowHalfY = window.innerHeight / 2;


                const wrapper = $(this);
                const video = $(this).find('video')[0];
                const textureLoader = new THREE.TextureLoader();
                const texture = textureLoader.load($(this).find("img").attr("src"));
                texture.encoding = THREE.sRGBEncoding;

    			init();

                fpsInterval = 1000 / fps;
                then = Date.now();
                startTime = then;

    			animate();

    			function init() {

        			console.log("init");

        			const threeWapper = $("<div class='three-normal'></div>");

        			threeWapper.hide();

        			setTimeout(function(){
                        threeWapper.fadeIn("slow");
        			}, 2000);

        			wrapper.append(threeWapper);

    				container = threeWapper[0];

    				camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 1000 );
    				camera.position.z = 12;

    				scene = new THREE.Scene();

    				// LIGHTS

    				ambientLight = new THREE.AmbientLight( 0xFFFFFF, 0.8);
    				scene.add( ambientLight );

    				//pointLight = new THREE.PointLight( 0xffffff, 10 );
    				//pointLight.position.set( 0, 0, 6 );
    				//scene.add( pointLight );

    				directionalLight = new THREE.DirectionalLight( 0xffffff, 4.5 );
    				directionalLight.position.set( 1, - 0.5, - 1 );
    				scene.add( directionalLight );

                    const normalMap = new THREE.VideoTexture( video );

    				let material = new THREE.MeshStandardMaterial( {
                        fog: false,
    					map: texture,
                        //specular: 0xFFFFFF, //Specular color of the material. Default is a Color set to 0x111111 (very dark grey).
                        //shininess: 1000,  //How shiny the .specular highlight is; a higher value gives a sharper highlight. Default is 30.
    					normalMap: normalMap,
    					normalScale: new THREE.Vector2( 1, 1 ),
                        //normalMapType: THREE.ObjectSpaceNormalMap,
    				} );

                    mesh = new THREE.Mesh(
                        new THREE.PlaneGeometry(26, 14),
                        material
                    );

                    scene.add( mesh );

                    scene.background = null;

    				renderer = new THREE.WebGLRenderer({
                       //antialias: true,
                       alpha: true
                    });

                    //renderer.setClearAlpha( 0 );
                    //renderer.setClearColor( 0x000000, 0 ); // the default
                    //renderer.outputColorSpace = THREE.SRGBColorSpace; // optional with post-processing

    				renderer.setSize( window.innerWidth, window.innerHeight );
    				container.appendChild( renderer.domElement );

    				//stats = new Stats();
    				//container.appendChild( stats.dom );
    				////wrapper.append(stats.dom);

    				document.addEventListener( 'mousemove', onDocumentMouseMove );
    				window.addEventListener( 'resize', onWindowResize );
    			}

    			//

    			function onWindowResize() {

    				const width = window.innerWidth;
    				const height = window.innerHeight;

    				camera.aspect = width / height;
    				camera.updateProjectionMatrix();

    				renderer.setSize( width, height );
    			}

    			function onDocumentMouseMove( event ) {
    				mouseX = ( event.clientX - windowHalfX );
    				mouseY = ( event.clientY - windowHalfY );
    			}


                var stop = false;
                var frameCount = 0;
                var $results = $("#results");
                var fps, fpsInterval, startTime, now, then, elapsed;

                fpsInterval = 30;



    			function animate() {
    				requestAnimationFrame( animate );

                    // calc elapsed time since last loop
                    now = Date.now();
                    elapsed = now - then;

                    // if enough time has elapsed, draw the next frame

                    if (elapsed > fpsInterval) {

                        // Get ready for next frame by setting then=now, but also adjust for your
                        // specified fpsInterval not being a multiple of RAF's interval (16.7ms)
                        then = now - (elapsed % fpsInterval);

                        // Put your drawing code here
                        render();
        				//stats.update();
                    }
    			}


    			function render() {

    				targetX = mouseX * .001;
    				targetY = -1 * mouseY * .002;

    				//console.log(mouseX, targetX, mouseY, targetY);

    				if ( mesh ) {

    					mesh.rotation.y = 0.2 * ( targetX - mesh.rotation.y );
    					mesh.rotation.x = 0.2 * ( targetY - mesh.rotation.x );

                        directionalLight.position.set( 1.5,  targetY, 1);
    				}

    				renderer.render( scene, camera );
    			}

            });

		</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L6M1VKE89V"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-L6M1VKE89V');
</script>

</body>
</html>