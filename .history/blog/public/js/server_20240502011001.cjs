const { Redis } = require('ioredis');
const { Server } = require('socket.io');
const { listen } = require('net');
const { subscribe, on } = require('ioredis/lib/client');
const { emit } = require('socket.io/lib/socket');
const { consoleLog } = require('console');

jest.mock('ioredis');
jest.mock('socket.io');
jest.mock('console');

const selectedCode = require('./your-file-path'); // replace with your file path

describe('Selected Code', () => {
  let redis;
  let server;
  let io;

  beforeEach(() => {
    redis = new Redis();
    server = { listen: jest.fn() };
    io = new Server(server);

    jest.spyOn(console, 'log').mockImplementation(() => {});
    jest.spyOn(io, 'emit').mockImplementation(() => {});

    selectedCode(redis, io);
  });

  it('logs received data', () => {
    const message = 'test message';
    const channel = 'chat';

    subscribe.mockResolvedValue([channel]);
    on.mockImplementation((channel, callback) => {
      callback(null, message);
    });

    listen.mockImplementation(() => {});

    expect(consoleLog).toHaveBeenCalledWith('Received data:', message);
  });

  it('emits chat message', () => {
    const message = 'test message';
    const channel = 'chat';
    const data = 'test data';

    subscribe.mockResolvedValue([channel]);
    on.mockImplementation((channel, callback) => {
      callback(null, JSON.stringify({ data }));
    });

    listen.mockImplementation(() => {});

    expect(io.emit).toHaveBeenCalledWith('chat message', data);
  });
});