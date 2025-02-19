const {
  time,
  loadFixture,
} = require("@nomicfoundation/hardhat-toolbox/network-helpers");
const { anyValue } = require("@nomicfoundation/hardhat-chai-matchers/withArgs");
const { expect } = require("chai");

// We define a fixture to reuse the same setup in every test.
// We use loadFixture to run this setup once, snapshot that state,
// and reset Hardhat Network to that snapshot in every test.
async function deployOneYearLockFixture() {
  const ONE_YEAR_IN_SECS = 365 * 24 * 60 * 60;
  const ONE_GWEI = 1_000_000_000;

  const lockedAmount = ONE_GWEI;
  const unlockTime = (await time.latest()) + ONE_YEAR_IN_SECS;

  // Contracts are deployed using the first signer/account by default
  //   const [owner, otherAccount] = await ethers.getSigners();

  const MyTest = await ethers.getContractFactory("MyTest");
  const myTest = await MyTest.deploy(unlockTime, { value: lockedAmount });

  console.log(`contract contain 1 ETH & address: ${myTest.address}`);
}

deployOneYearLockFixture().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
