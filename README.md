# Satellite Mission Monitor

A simulated Satellite Mission Monitoring system designed for learning and experimentation. This project displays live-like telemetry for fictional satellites, processes health flags using bit manipulation, and provides a UI for monitoring and debugging.

> All data in this project is fictional and not sourced from real satellites.

## Features

- Displays satellite metrics:  
  - Altitude (km)  
  - Battery (%)  
  - Velocity (km/s)  
  - System Status  
- Health Flag Generator with bitwise status representation:
  - `OK`  
  - `Low Battery`  
  - `Coms Fault`
- Bit manipulation used to encode and decode status flags
- Simple, modular codebase for learning purposes

## Example Data

| Name        | Altitude (km) | Battery (%) | Velocity (km/s) | Status                   |
|-------------|---------------|-------------|------------------|-------------------------|
| Atlantis    | 350           | 78%         | 7.8              | Low Battery, Coms Fault |
| Challenger  | 1200          | 55%         | 6.2              | OK                      |

## Health Flag System

Each status is encoded using bits:

| Flag         | Bit Value |
|--------------|-----------|
| OK           | `0b1`     |
| Low Battery  | `0b10`    |
| Coms Fault   | `0b100`   |

The system can generate and decode these flags using bitwise operations.
