<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>賽博朋克風格登入頁面</title>
    <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
</head>
<body>
    <div id="info"><a href="https://threejs.org" target="_blank" rel="noopener">three.js</a> css3d - sprites</div>
	<div id="container"></div>
    <script type="module" src="{{ asset('js/three.js') }}"></script>
    <div id="scene-container"></div>
    <div class="login-container">
        <form class="login-form">
            <label for="username">使用者名稱:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密碼:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">登入</button>
        </form>
    </div>
    <script>
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
    </script>
</body>
</html>
