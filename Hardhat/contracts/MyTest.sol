// SPDX-License-Identifier: UNLICENSED
pragma solidity ^0.8.28;

import "hardhat/console.sol";

contract MyTest{
    uint256 public unlockedTime;
    address payable public owner;

    event Withdrawal(uint256 amount, uint when);

    constructor(uint256 _unlockedTime) payable {
        require(block.timestamp < _unlockedTime, "unlocked time should be in the future!");

        unlockedTime = _unlockedTime;
        owner = payable(msg.sender);
    }

    function withdraw() public {
        require(block.timestamp >= unlockedTime, "wait till time is completed");
        require(msg.sender == owner, "you are not the owner");

        emit Withdrawal(address(this).balance, block.timestamp);

        owner.transfer(address(this).balance);
    }
}