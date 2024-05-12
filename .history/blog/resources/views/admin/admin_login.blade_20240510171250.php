<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My first three.js app</title>
    <style>
        body { margin: 0; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/three@0.164.1/build/three.module.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.164.1/examples/jsm/"></script>
    <!-- 其他所需的 Three.js 檔案 -->
</head>
<body>
    <script type="module" src="/main.js"></script>
    <script>
        // 您的 JavaScript 代碼放在這裡
        // 創建場景
        var scene = new THREE.Scene();

        // 添加相機
        var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 5;
        scene.add(camera);

        // 添加渲染器
        var renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // 添加燈光
        var ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(ambientLight);

        var pointLight = new THREE.PointLight(0xffffff, 0.5);
        pointLight.position.set(10, 10, 10);
        scene.add(pointLight);

        // 添加幾何體
        var geometry = new THREE.BoxGeometry(1, 1, 1);
        var material = new THREE.MeshPhongMaterial({ color: 0x00ff00 });
        var cube = new THREE.Mesh(geometry, material);
        scene.add(cube);

        // 渲染場景
        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }
        animate();

        // 添加登入表單（HTML/CSS 部分）
        var loginForm = document.createElement('div');
        loginForm.innerHTML = `
            <form id="loginForm">
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
        `;
        loginForm.style.position = 'absolute';
        loginForm.style.top = '50%';
        loginForm.style.left = '50%';
        loginForm.style.transform = 'translate(-50%, -50%)';
        document.body.appendChild(loginForm);

        // 將 Three.js 场景集成到登入頁面
        function integrateScene() {
            var domElement = renderer.domElement;
            domElement.style.position = 'absolute';
            domElement.style.top = '0';
            domElement.style.left = '0';
            document.body.appendChild(domElement);
        }
        integrateScene();

    </script>
</body>
</html>
