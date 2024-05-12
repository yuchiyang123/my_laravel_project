import * as THREE from 'three';

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ alpha: true }); // 使用透明背景
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('scene-container').appendChild(renderer.domElement);

const geometry = new THREE.BoxGeometry();
const material = new THREE.MeshBasicMaterial({ color: 0x00ff00, wireframe: true });
const cube = new THREE.Mesh(geometry, material);
scene.add(cube);

camera.position.z = 5;

const ambientLight = new THREE.AmbientLight(0x555555);
scene.add(ambientLight);

const pointLight = new THREE.PointLight(0xffffff, 1, 100);
pointLight.position.set(10, 10, 10);
scene.add(pointLight);

function animate() {
    requestAnimationFrame(animate);
    cube.rotation.x += 0.01;
    cube.rotation.y += 0.01;
    renderer.render(scene, camera);
}

animate();

// 增加與表單互動
document.getElementById('username').addEventListener('focus', function() {
    cube.material.color.setHex(0xff0000); // 切換為紅色
});

document.getElementById('username').addEventListener('blur', function() {
    cube.material.color.setHex(0x00ff00); // 回到原色
});

document.getElementById('password').addEventListener('focus', function() {
    cube.material.color.setHex(0x0000ff); // 切換為藍色
});

document.getElementById('password').addEventListener('blur', function() {
    cube.material.color.setHex(0x00ff00); // 回到原色
});
