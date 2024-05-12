import * as THREE from 'three';

			import TWEEN from 'three/addons/libs/tween.module.js';
			import { TrackballControls } from 'three/addons/controls/TrackballControls.js';
			import { CSS3DRenderer, CSS3DSprite } from 'three/addons/renderers/CSS3DRenderer.js';
            
let scene, camera, renderer, controls, loader;

        init();
        animate();

        function init() {
            const container = document.getElementById('scene-container');

            // Scene
            scene = new THREE.Scene();

            // Camera
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.set(0, 1, 2);

            // Renderer
            renderer = new THREE.WebGLRenderer();
            renderer.setSize(window.innerWidth, window.innerHeight);
            container.appendChild(renderer.domElement);

            // Controls
            controls = new THREE.OrbitControls(camera, renderer.domElement);

            // Loader
            loader = new THREE.GLTFLoader();
            loader.load('image/dog.gltf', function(gltf) {
                scene.add(gltf.scene);
            });

            // Lighting
            const light = new THREE.HemisphereLight(0xffffbb, 0x080820, 1);
            scene.add(light);
        }

        function animate() {
            requestAnimationFrame(animate);
            controls.update();
            renderer.render(scene, camera);
        }    