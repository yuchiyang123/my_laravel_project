import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // 创建登录表单的3D对象
        const loginContainer = new THREE.Mesh(
            new THREE.BoxGeometry(4, 2, 0.1),
            new THREE.MeshBasicMaterial({ color: 0xaaaaaa })
        );
        loginContainer.position.z = -5;
        scene.add(loginContainer);

        // 创建用户名输入框的3D对象
        const usernameInput = new THREE.Mesh(
            new THREE.BoxGeometry(3, 1, 0.1),
            new THREE.MeshBasicMaterial({ color: 0xffffff })
        );
        usernameInput.position.set(0, 0.5, 0.1);
        loginContainer.add(usernameInput);

        // 创建密码输入框的3D对象
        const passwordInput = new THREE.Mesh(
            new THREE.BoxGeometry(3, 1, 0.1),
            new THREE.MeshBasicMaterial({ color: 0xffffff })
        );
        passwordInput.position.set(0, -0.5, 0.1);
        loginContainer.add(passwordInput);

        // 渲染循环
        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }
        animate();