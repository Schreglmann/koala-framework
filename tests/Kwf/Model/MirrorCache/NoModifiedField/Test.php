<?php
/**
 * @group Model
 * @group Model_MirrorCache
 */
class Kwf_Model_MirrorCache_NoModifiedField_Test extends Kwf_Test_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->_sourceModel = new Kwf_Model_FnF(array(
            'uniqueIdentifier' => 'unique',
            'columns' => array('id', 'firstname', 'lastname', 'timefield'),
            'uniqueColumns' => array('id'),
            'data' => array(
                array('id' => 1, 'firstname' => 'Max', 'timefield' => '2008-06-09 00:00:00'),
                array('id' => 2, 'firstname' => 'Susi', 'timefield' => '2008-07-09 10:00:00'),
                array('id' => 3, 'firstname' => 'Kurt', 'timefield' => '2008-07-15 20:00:00')
            )
        ));
        $this->_mirrorModel = new Kwf_Model_FnF(array(
            'uniqueIdentifier' => 'unique',
            'columns' => array('id', 'firstname', 'lastname', 'timefield'),
            'uniqueColumns' => array('id'),
            'data' => array(
                array('id' => 1, 'firstname' => 'Max', 'timefield' => '2008-06-09 00:00:00'),
                array('id' => 2, 'firstname' => 'Susi', 'timefield' => '2008-07-09 10:00:00')
            )
        ));
        $this->_proxyModel = new Kwf_Model_MirrorCache(array(
            'proxyModel' => $this->_mirrorModel,
            'sourceModel' => $this->_sourceModel,
            'maxSyncDelay' => 0
        ));
    }

    public function testRequests()
    {
        Kwf_Benchmark::enable();
        Kwf_Benchmark::reset();

        $this->_proxyModel->getRows();
        $this->assertEquals(1, Kwf_Benchmark::getCounterValue('mirror sync'));
        $this->_proxyModel->getRow(3);
        $this->assertEquals(1, Kwf_Benchmark::getCounterValue('mirror sync'));
        $this->_proxyModel->getIds();
        $this->assertEquals(1, Kwf_Benchmark::getCounterValue('mirror sync'));
        $this->_proxyModel->countRows();
        $this->assertEquals(1, Kwf_Benchmark::getCounterValue('mirror sync'));

        Kwf_Benchmark::disable();
    }

    public function testInitialSync()
    {
        $m = $this->_getModel();
        $r = $m->getRow(3);
        $this->assertEquals(3, $r->id);
        $this->assertEquals('Kurt', $r->firstname);
    }

    private function _getModel()
    {
        return $this->_proxyModel;
    }
}
